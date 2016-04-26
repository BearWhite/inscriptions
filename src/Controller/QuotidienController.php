<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class QuotidienController extends AppController {

    protected $_ExcelTitle1 = array(
        'font' => array(
            'bold' => true,
            'size' => 16,
            'name' => 'Arial',
        ),
        'alignment' => array(
            //'shrinkToFit'=>true,
            'wrap' => true,
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );
    protected $_ExcelBold = array(
        'font' => array(
            'bold' => true,
            'size' => 12,
            'name' => 'Arial'
        ),
        'alignment' => array(
            'shrinkToFit' => false,
            'wrap' => true,
            //'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );
    protected $_ExcelTableHead = array(
        'font' => array(
            'bold' => true,
            'size' => 12,
            'name' => 'Arial',
        ),
        'borders' => array(
            'allborders' => array(
                'style' => \PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'shrinkToFit' => false,
            'wrap' => true,
            //'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );
    protected $_ExcelTableBody = array(
        'font' => array(
            'bold' => false,
            'size' => 12,
            'name' => 'Arial',
        ),
        'borders' => array(
            'allborders' => array(
                'style' => \PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'shrinkToFit' => false,
            'wrap' => true,
            'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );

    public function index() {

        $parcours = TableRegistry::get('Parcours')
                ->find('all');
        $liste_parcours = array();
        $liste_promotions = array();

        $specialites = TableRegistry::get('Specialites')
                ->find('all');
        foreach ($specialites as $specialite) {
            $annees = $specialite->getAnneeBySpecialite()->hydrate(false)->toArray();
            $arr = array();
            foreach ($annees as $annee) {
                $liste_promotions[$specialite->id . '-' . $annee['année']] = TableRegistry::get('Specialites')->getFullTitle($specialite->id) . ' ▸ ' . $annee['année'];
            }
        }

        foreach ($parcours as $parcour) {
            $liste_parcours[$parcour->id] = $parcour->getFullTitle();
        }

        $parcour_id = (!isset($this->request->query['parcour_id'])) ? key($liste_parcours) : $this->request->query['parcour_id'];
        $promotion_get = (!isset($this->request->query['promotion_select'])) ? key($liste_promotions) : $this->request->query['promotion_select'];
        $promotion_get_a = explode('-', $promotion_get);


        $promotion_specialite_id = $promotion_get_a[0];
        $promotion_annee = $promotion_get_a[1];

        $parcours_promotion = TableRegistry::get('Parcours')
                ->find('all')
                ->where(['specialite_id' => $promotion_specialite_id, 'année' => $promotion_annee]);

        $modules_ids = array();

        foreach ($parcours_promotion as $parcour) {
            $groupes = TableRegistry::get('Parcours')
                            ->get($parcour->id, [
                                'contain' => [
                                    'Groupes.Modules',
                        ]])->groupes;
            foreach ($groupes as $groupe) {
                $modules_ids[] = $groupe->module->id;
            }
        }


        array_unique($modules_ids);

        $modules = TableRegistry::get('Modules')
                ->find('all', [
                    'contain' => [
                        'Groupes.Utilisateurs'
                    ]
                ])
                ->where(['id IN' => $modules_ids]);

        $modules_count = 0;
        foreach ($modules as $m) {
            $modules_count++;
        }

        $this->set(compact('parcours', 'liste_parcours', 'parcour_id', 'groupes', 'modules', 'liste_promotions', 'promotion_get', 'modules_count'));
    }

    public function feuilleparcour() {
        $this->autoRender = false;
        if (isset($this->request->query['parcour_id'])) {
            $parcour_id = $this->request->query['parcour_id'];
            $parcour = TableRegistry::get('Parcours')
                    ->get($parcour_id);
            $classeur = $this->_openWorkBook();
            $this->_generateParcourSheet($classeur, $parcour_id, 0);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $parcour->getFullTitle() . '.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = \PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');
            $writer->save('php://output');
        }
    }

    public function feuilleparcours() {
        $this->autoRender = false;
        $specialites = TableRegistry::get('Specialites')
                ->find('all');

        $parcours = TableRegistry::get('Parcours')
                ->find('all');
        $classeur = $this->_openWorkBook();
        $i = 0;

        foreach ($specialites as $specialite) {
            $i = $this->_generateYearSheet($classeur, $specialite->id, $i);
        }

        foreach ($parcours as $parcour) {
            $this->_generateParcourSheet($classeur, $parcour->id, $i);
            $i++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="parcours.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = \PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');
        $writer->save('php://output');
    }

    public function feuillemodule() {
        $this->autoRender = false;
        if (isset($this->request->query['module_id'])) {
            $module_id = $this->request->query['module_id'];
            $module = TableRegistry::get('Modules')
                    ->get($module_id);
            $classeur = $this->_openWorkBook();
            $this->_generateModuleSheet($classeur, $module_id, 0);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $module->getFullTitle() . '.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = \PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');
            $writer->save('php://output');
        }
    }

    public function feuillemodules() {
        $this->autoRender = false;

        if (isset($this->request->query['promotion'])) {

            $promotion_select = explode('-', $this->request->query['promotion']);

            $parcours_promotion = TableRegistry::get('Parcours')
                    ->find('all')
                    ->where(['specialite_id' => $promotion_select[0], 'année' => $promotion_select[1]]);

            $modules_ids = array();

            foreach ($parcours_promotion as $parcour) {
                $groupes = TableRegistry::get('Parcours')
                                ->get($parcour->id, [
                                    'contain' => [
                                        'Groupes.Modules',
                            ]])->groupes;
                foreach ($groupes as $groupe) {
                    $modules_ids[] = $groupe->module->id;
                }
            }

            array_unique($modules_ids);

            $modules = TableRegistry::get('Modules')
                    ->find('all', [
                        'contain' => [
                            'Groupes.Utilisateurs'
                        ]
                    ])
                    ->where(['id IN' => $modules_ids]);

            $classeur = $this->_openWorkBook();
            $i = 0;
            foreach ($modules as $module) {
                $this->_generateModuleSheet($classeur, $module->id, $i);
                $i++;
            }



            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="modules.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = \PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');
            $writer->save('php://output');
        }
    }

    protected function _generateYearSheet($workbook, $specialite_id, $sheetIndex) {
        $specialite = TableRegistry::get('Specialites')
                ->get($specialite_id);
        $annees = $specialite->getAnneeBySpecialite()->hydrate(false)->toArray();
        $arr = array();
        foreach ($annees as $annee) {
            $arr[$annee['année']] = $annee['année'];
        }
        $annees = $arr;

        foreach ($annees as $annee) {
            $parcours = TableRegistry::get('Parcours')
                    ->find('all')
                    ->where(['année' => $annee, 'specialite_id' => $specialite_id])
                    ->where(['role_id' => 2]);

            $utilisateurs_id = array();
            foreach ($parcours as $parcour) {
                $utilisateurs_tmp = TableRegistry::get('Utilisateurs')
                        ->find('all')
                        ->where(['parcour_id' => $parcour->id])
                        ->where(['role_id' => 2])
                        ->order('nom');
                foreach ($utilisateurs_tmp as $utilisateur) {
                    $utilisateurs_id[] = $utilisateur->id;
                }
            }

            $arr_utilisateurs = TableRegistry::get('Utilisateurs')
                    ->find('all')
                    ->where(['id IN' => $utilisateurs_id])
                    ->where(['role_id' => 2])
                    ->order(['nom', 'prenom']);

            $sheet = $this->_getSheetByIndex($workbook, $sheetIndex);

            $this->_drawLogo($sheet);

            //$sheet->setTitle(substr(TableRegistry::get('Specialites')->getFullTitle($specialite_id) . ' ▸ ' . $annee, 0, 31));
            $sheet = $this->_setTitleSheet($sheet, TableRegistry::get('Specialites')->getFullTitle($specialite_id) . ' ▸ ' . $annee);
            $columnA = 50;
            $columnB = 50;

            $sheet->getColumnDimension('A')->setWidth($columnA);
            $sheet->getColumnDimension('B')->setWidth($columnB);
            $sheet->getRowDimension('1')->setRowHeight(40);
            $sheet->getRowDimension('2')->setRowHeight(40);
            $sheet->getRowDimension('3')->setRowHeight(40);

            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->applyFromArray($this->_ExcelTitle1);
            $sheet->setCellValue('A1', 'Master STIC 2014-15');

            $sheet->mergeCells('A2:B2');
            $sheet->getStyle('A2')->applyFromArray($this->_ExcelTitle1);

            $sheet->setCellValue('A2', TableRegistry::get('Specialites')->getFullTitle($specialite_id) . ' ▸ ' . $annee);

            $sheet->getStyle('A3')->applyFromArray($this->_ExcelBold);
            $sheet->setCellValue('A3', 'Date : .....................');

            $sheet->getStyle('B3')->applyFromArray($this->_ExcelBold);
            $sheet->setCellValue('B3', 'Enseignant : ..........................................................');

            $sheet->getStyle('A5')->applyFromArray($this->_ExcelTableHead);
            $sheet->setCellValue('A5', 'Etudiant');

            $sheet->getStyle('B5')->applyFromArray($this->_ExcelTableHead);
            $sheet->setCellValue('B5', 'Signature');

            $i = 6;

            foreach ($arr_utilisateurs as $utilisateur) {
                $sheet->getRowDimension($i)->setRowHeight(30);
                $sheet->getStyle('A' . $i)->applyFromArray($this->_ExcelTableBody);
                $sheet->setCellValue('A' . $i, strtoupper($utilisateur->nom) . '   ' . $utilisateur->prenom);
                $sheet->getStyle('B' . $i)->applyFromArray($this->_ExcelTableBody);
                $sheet->setCellValue('B' . $i, '');
                $i++;
            }
            $sheetIndex++;
        }


        return $sheetIndex;
    }

    protected function _generateParcourSheet($workbook, $parcour_id, $sheetIndex) {
        $parcour = TableRegistry::get('Parcours')
                ->get($parcour_id);

        $arr_utilisateurs = $parcour->getUtilisateursFromParcours($parcour->id);
        $arr_utilisateurs_ids = array();
        foreach ($arr_utilisateurs as $utilisateur) {
            $arr_utilisateurs_ids[] = $utilisateur->id;
        }

        $utilisateurs = TableRegistry::get('Utilisateurs')
                ->find('all')
                ->where(['id IN' => $arr_utilisateurs_ids])
                ->where(['role_id' => 2])
                ->order(['nom', 'prenom']);

        $sheet = $this->_getSheetByIndex($workbook, $sheetIndex);

        $this->_drawLogo($sheet);

        //$sheet->setTitle(substr(TableRegistry::get('Parcours')->getFullTitle($parcour_id), 0, 31));
        $sheet = $this->_setTitleSheet($sheet, TableRegistry::get('Parcours')->getFullTitle($parcour_id));
        $columnA = 50;
        $columnB = 50;

        $sheet->getColumnDimension('A')->setWidth($columnA);
        $sheet->getColumnDimension('B')->setWidth($columnB);
        $sheet->getRowDimension('1')->setRowHeight(40);
        $sheet->getRowDimension('2')->setRowHeight(40);
        $sheet->getRowDimension('3')->setRowHeight(40);

        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->applyFromArray($this->_ExcelTitle1);
        $sheet->setCellValue('A1', 'Master STIC 2014-15');

        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A2')->applyFromArray($this->_ExcelTitle1);

        $sheet->setCellValue('A2', TableRegistry::get('Parcours')->getFullTitle($parcour_id));

        $sheet->getStyle('A3')->applyFromArray($this->_ExcelBold);
        $sheet->setCellValue('A3', 'Date : .....................');

        $sheet->getStyle('B3')->applyFromArray($this->_ExcelBold);
        $sheet->setCellValue('B3', 'Enseignant : ..........................................................');

        $sheet->getStyle('A5')->applyFromArray($this->_ExcelTableHead);
        $sheet->setCellValue('A5', 'Etudiant');

        $sheet->getStyle('B5')->applyFromArray($this->_ExcelTableHead);
        $sheet->setCellValue('B5', 'Signature');

        $i = 6;

        foreach ($utilisateurs as $utilisateur) {
            $sheet->getRowDimension($i)->setRowHeight(30);
            $sheet->getStyle('A' . $i)->applyFromArray($this->_ExcelTableBody);
            $sheet->setCellValue('A' . $i, strtoupper($utilisateur->nom) . '   ' . $utilisateur->prenom);
            $sheet->getStyle('B' . $i)->applyFromArray($this->_ExcelTableBody);
            $sheet->setCellValue('B' . $i, '');
            $i++;
        }
    }

    protected function _generateModuleSheet($workbook, $module_id, $sheetIndex) {
        $module = TableRegistry::get('Modules')
                ->get($module_id);

        $groupes = TableRegistry::get('Groupes')
                ->find('all', [
                    'contain' => 'Utilisateurs',
                ])
                ->where(['module_id' => $module_id]);

        $arr_utilisateurs_id = array();
        foreach ($groupes as $groupe) {
            if ($groupe->obligatoire) {
                foreach ($groupe->getAllUtilisateursFromParcours() as $utilisateur) {
                    $arr_utilisateurs_id[] = $utilisateur->id;
                }
            } else {
                foreach ($groupe->utilisateurs as $utilisateur) {
                    $arr_utilisateurs_id[] = $utilisateur->id;
                }
            }
        }

        $utilisateurs = TableRegistry::get('Utilisateurs')
                ->find('all')
                ->where(['id IN' => $arr_utilisateurs_id])
                ->where(['role_id' => 2])
                ->order(['nom', 'prenom']);



        $sheet = $this->_getSheetByIndex($workbook, $sheetIndex);

        $this->_drawLogo($sheet);

        //$sheet->setTitle(substr($module->code . ' - ' . $module->title, 0, 31));
        $sheet = $this->_setTitleSheet($sheet, $module->code . ' - ' . $module->title);
        $columnA = 50;
        $columnB = 50;

        $sheet->getColumnDimension('A')->setWidth($columnA);
        $sheet->getColumnDimension('B')->setWidth($columnB);
        $sheet->getRowDimension('1')->setRowHeight(40);
        $sheet->getRowDimension('2')->setRowHeight(40);
        $sheet->getRowDimension('3')->setRowHeight(40);

        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->applyFromArray($this->_ExcelTitle1);
        $sheet->setCellValue('A1', 'Master STIC 2014-15');

        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A2')->applyFromArray($this->_ExcelTitle1);

        $sheet->setCellValue('A2', $module->code . ' - ' . $module->title);

        $sheet->getStyle('A3')->applyFromArray($this->_ExcelBold);
        $sheet->setCellValue('A3', 'Date : .....................');

        $sheet->getStyle('B3')->applyFromArray($this->_ExcelBold);
        $sheet->setCellValue('B3', 'Enseignant : ..........................................................');

        $sheet->getStyle('A5')->applyFromArray($this->_ExcelTableHead);
        $sheet->setCellValue('A5', 'Etudiant');

        $sheet->getStyle('B5')->applyFromArray($this->_ExcelTableHead);
        $sheet->setCellValue('B5', 'Signature');

        $i = 6;

        foreach ($utilisateurs as $utilisateur) {
            $sheet->getRowDimension($i)->setRowHeight(30);
            $sheet->getStyle('A' . $i)->applyFromArray($this->_ExcelTableBody);
            $sheet->setCellValue('A' . $i, strtoupper($utilisateur->nom) . '   ' . $utilisateur->prenom);
            $sheet->getStyle('B' . $i)->applyFromArray($this->_ExcelTableBody);
            $sheet->setCellValue('B' . $i, '');
            $i++;
        }
    }

    protected function _openWorkBook() {
        $workbook = new \PHPExcel();
        // Set document properties
        $workbook->getProperties()->setCreator("Master STIC")
                ->setLastModifiedBy("Master STIC")
                ->setTitle("Emargement Master STIC")
                ->setSubject("Emargement Master STIC")
                ->setDescription("Emragement général et UE par UE master STIC")
                ->setKeywords("Emargement Master STIC")
                ->setCategory("Emargement");

        return $workbook;
    }

    protected function _getSheetByIndex(\PHPExcel $workbook, $index) {
        if ($index == 0) {
            $workbook->setActiveSheetIndex(0);
            return $workbook->getActiveSheet();
        } else {
            return $workbook->createSheet($index);
        }
    }

    protected function _setTitleSheet($sheet, $title) {
        $arr_invalid = array('*', ':', '/', '\\', '?', '[', ']');
        $sub_title = substr($title, 0, 31);
        $clean_title = str_replace($arr_invalid, ' ', $sub_title);
        $sheet->setTitle($clean_title);
        return $sheet;
    }

    protected function _drawLogo($sheet) {
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('logoUPJV');
        $objDrawing->setDescription('Logo UPJV');
        $objDrawing->setPath('img/logoUPJV.gif');
        $objDrawing->setHeight(90);
        $objDrawing->setCoordinates('A1');
        //$objDrawing->setOffsetX(-10);
        $objDrawing->setWorksheet($sheet);

        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('logodomaine');
        $objDrawing->setDescription('Logo domaine');
        $objDrawing->setPath('img/logodomaine.gif');
        $objDrawing->setHeight(90);
        $objDrawing->setCoordinates('C1');
        $objDrawing->setOffsetX(-78);
        $objDrawing->setWorksheet($sheet);
    }

}