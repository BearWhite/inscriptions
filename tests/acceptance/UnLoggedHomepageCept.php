<?php use App\Test\Acceptance\AcceptanceTester;

$I = new AcceptanceTester($scenario);
$I->wantTo('load the front page of the site and see the homepage');
$I->amOnPage('/');
$I->see('Cette application permet aux étudiants du Master STIC - ISRI, MIAGE et 2IBS de choisir leurs UE optionnelles');
