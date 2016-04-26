<?php

use App\Test\Acceptance\AcceptanceTester;
use Cake\ORM\TableRegistry;

$I = new AcceptanceTester($scenario);
$I->wantTo('register to access the website');
$mention_id = $I->haveRecord('mentions', ['title' => 'STIC']);
$specialite_id = $I->haveRecord('specialites', ['title' => 'MIAGE', 'mention_id' => $mention_id]);
$parcour_id = $I->haveRecord('parcours', ['title' => '2COM', 'année' => '2', 'specialite_id' => $specialite_id]);
$I->amOnPage('/utilisateurs/inscription');
$I->fillField('prenom', 'Miles');
$I->fillField('nom', 'Davis');
$I->fillField('identifiant', 'd.miles');
$I->fillField('email', 'test@example.org');
$I->fillField('telephone', '0123456789');
$I->fillField('motdepasse', 'test');
$I->selectOption('parcour_id','STIC ▸ MIAGE 2 ▸ 2COM');
$I->click('input[type=submit]');
$I->see('Votre compte a été créé');
$I->seeRecord('utilisateurs', ['identifiant' => 'd.miles']);

//On supprime l'enregistrement ajouté pour pouvoir rejouer le test
//autant de fois qu'on le souhaite.
$tableUtilisateurs = TableRegistry::get('Utilisateurs');
$utilisateur = $I->grabRecord('utilisateurs', ['identifiant' => 'd.miles']);
$tableUtilisateurs->delete($utilisateur);
