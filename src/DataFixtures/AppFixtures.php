<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Character;
use App\Entity\CharacterCLass;
use App\Entity\Race;
use App\Entity\Skill;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $human = new Race();
        $human->setName('Humain');
        $human->setDescription('Polyvalents et ambitieux, les humains sont la race la plus répandue.');
        $manager->persist($human);

        $elfe = new Race();
        $elfe->setName('Elfe');
        $elfe->setDescription('Gracieux et longévifs, les elfes possèdent une affinité naturelle avec la magie.');
        $manager->persist($elfe);

        $nain = new Race();
        $nain->setName('Nain');
        $nain->setDescription('Robustes et tenaces, les nains sont des artisans et guerriers réputés.');
        $manager->persist($nain);

        $half = new Race();
        $half->setName('Halfelin');
        $half->setDescription('Petits et agiles, les halfelins sont connus pour leur chance et leur discrétion.');
        $manager->persist($half);

        $orc = new Race();
        $orc->setName('Demi-Orc');
        $orc->setDescription("Forts et endurants, les demi-orcs allient la puissance des orcs à l'adaptabilité humaine.");
        $manager->persist($orc);

        $gno = new Race();
        $gno->setName('Gnome');
        $gno->setDescription("Curieux et inventifs, les gnomes excellent dans les domaines de la magie et de la technologie.");
        $manager->persist($gno);

        $Tiefl = new Race();
        $Tiefl->setName('Tieffelin');
        $Tiefl->setDescription("Descendants d'une lignée infernale, les tieffelins portent la marque de leur héritage.");
        $manager->persist($Tiefl);

        $d_elfe = new Race();
        $d_elfe->setName('Demi-Elfe');
        $d_elfe->setDescription("Héritant du meilleur des deux mondes, les demi-elfes sont diplomates et polyvalents.");
        $manager->persist($d_elfe);

        $barb = new characterCLass();
        $barb->setName('Barbare');
        $barb->setDescription("Guerrier sauvage animé par une rage dévastatrice.");
        $barb->setHitDice(12);
        $manager->persist($barb);

        $Barde = new characterCLass();
        $Barde->setName('Barde');
        $Barde->setDescription("Artiste et conteur dont la musique possède un pouvoir magique.");
        $Barde->setHitDice(8);
        $manager->persist($Barde);

        $Clerc = new characterCLass();
        $Clerc->setName('Clerc');
        $Clerc->setDescription("Serviteur divin canalisant la puissance de sa divinité.");
        $Clerc->setHitDice(8);
        $manager->persist($Clerc);

        $Druide = new characterCLass();
        $Druide->setName('Druide');
        $Druide->setDescription("Gardien de la nature capable de se métamorphoser.");
        $Druide->setHitDice(8);
        $manager->persist($Druide);

        $Guerrier = new characterCLass();
        $Guerrier->setName('Guerrier');
        $Guerrier->setDescription("Maître des armes et des tactiques de combat.");
        $Guerrier->setHitDice(10);
        $manager->persist($Guerrier);

        $Mage = new characterCLass();
        $Mage->setName('Mage');
        $Mage->setDescription("Érudit de l'arcane maîtrisant de puissants sortilèges.");
        $Mage->setHitDice(6);
        $manager->persist($Mage);

        $Paladin = new characterCLass();
        $Paladin->setName('Paladin');
        $Paladin->setDescription("Chevalier sacré combinant prouesse martiale et magie divine.");
        $Paladin->setHitDice(10);
        $manager->persist($Paladin);

        $Ranger = new characterCLass();
        $Ranger->setName('Ranger');
        $Ranger->setDescription("Chasseur et pisteur expert des terres sauvages.");
        $Ranger->setHitDice(10);
        $manager->persist($Ranger);

        $Sorcier = new characterCLass();
        $Sorcier->setName('Sorcier');
        $Sorcier->setDescription("Lanceur de sorts dont le pouvoir est inné et instinctif.");
        $Sorcier->setHitDice(6);
        $manager->persist($Sorcier);

        $Voleur = new characterCLass();
        $Voleur->setName('Voleur');
        $Voleur->setDescription("Spécialiste de la discrétion, du crochetage et des attaques sournoises.");
        $Voleur->setHitDice(8);
        $manager->persist($Voleur);

        $skillset = [
            ["label" => "Acrobaties", "asi"=>	"DEX"],
            ["label" => "Arcanes", "asi"=>	"INT"],
            ["label" => "Athlétisme", "asi"=>	"STR"],
            ["label" => "Discrétion", "asi"=>	"DEX"],
            ["label" => "Dressage", "asi"=>	"WIS"],
            ["label" => "Escamotage", "asi"=>	"DEX"],
            ["label" => "Histoire", "asi"=>	"INT"],
            ["label" => "Intimidation", "asi"=>	"CHA"],
            ["label" => "Investigation", "asi"=>	"INT"],
            ["label" => "Médecine", "asi"=>	"WIS"],
            ["label" => "Nature", "asi"=>	"INT"],
            ["label" => "Perception", "asi"=>	"WIS"],
            ["label" => "Perspicacité", "asi"=>	"WIS"],
            ["label" => "Persuasion", "asi"=>	"CHA"],
            ["label" => "Religion", "asi"=>	"INT"],
            ["label" => "Représentation", "asi"=>	"CHA"],
            ["label" => "Survie", "asi"=>	"WIS"],
            ["label" => "Tromperie", "asi"=>	"CHA"],
        ];

        $allclasses = [$Ranger, $Voleur, $Sorcier, $Mage, $Paladin, $Guerrier, $Druide, $Clerc, $Barde, $barb];
        $classcount = count($allclasses);



       foreach ($skillset as $skill) {
           $newSkill = new Skill();
           $newSkill->setName($skill["label"]);
           $newSkill->setAbility($skill["asi"]);
           $newSkill->setIdClass($allclasses[rand(0, $classcount-1)]);
           $manager->persist($newSkill);
       }

        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('admin'));
        $admin->setEmail('admin@gmail.com');
        $manager->persist($admin);

        $manager->flush();

    }
}
