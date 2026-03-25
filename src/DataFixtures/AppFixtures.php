<?php

namespace App\DataFixtures;

use App\Entity\User;
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
    ) {}

    public function load(ObjectManager $manager): void
    {
        // ===================== RACES =====================
        $racesData = [
            ['Humain',    'Polyvalents et ambitieux, les humains sont la race la plus répandue.'],
            ['Elfe',      'Gracieux et longévifs, les elfes possèdent une affinité naturelle avec la magie.'],
            ['Nain',      'Robustes et tenaces, les nains sont des artisans et guerriers réputés.'],
            ['Halfelin',  'Petits et agiles, les halfelins sont connus pour leur chance et leur discrétion.'],
            ['Demi-Orc',  "Forts et endurants, les demi-orcs allient la puissance des orcs à l'adaptabilité humaine."],
            ['Gnome',     "Curieux et inventifs, les gnomes excellent dans les domaines de la magie et de la technologie."],
            ['Tieffelin', "Descendants d'une lignée infernale, les tieffelins portent la marque de leur héritage."],
            ['Demi-Elfe', "Héritant du meilleur des deux mondes, les demi-elfes sont diplomates et polyvalents."],
        ];

        foreach ($racesData as [$name, $desc]) {
            $race = new Race();
            $race->setName($name);
            $race->setDescription($desc);
            $manager->persist($race);
        }

        // ===================== CLASSES =====================
        $classesData = [
            ['Barbare', 12, "Guerrier sauvage animé par une rage dévastatrice."],
            ['Barde',    8, "Artiste et conteur dont la musique possède un pouvoir magique."],
            ['Clerc',    8, "Serviteur divin canalisant la puissance de sa divinité."],
            ['Druide',   8, "Gardien de la nature capable de se métamorphoser."],
            ['Guerrier', 10, "Maître des armes et des tactiques de combat."],
            ['Mage',     6, "Érudit de l'arcane maîtrisant de puissants sortilèges."],
            ['Paladin',  10, "Chevalier sacré combinant prouesse martiale et magie divine."],
            ['Ranger',   10, "Chasseur et pisteur expert des terres sauvages."],
            ['Sorcier',  6, "Lanceur de sorts dont le pouvoir est inné et instinctif."],
            ['Voleur',   8, "Spécialiste de la discrétion, du crochetage et des attaques sournoises."],
        ];

        $classes = [];
        foreach ($classesData as [$name, $hitDice, $desc]) {
            $class = new CharacterCLass();
            $class->setName($name);
            $class->setDescription($desc);
            $class->setHitDice($hitDice);
            $manager->persist($class);
            $classes[$name] = $class;
        }

        // ===================== COMPÉTENCES =====================
        // Association classes-compétences (2 à 4 par classe)
        $skillsData = [
            ['Acrobaties',   'DEX', 'Voleur'],
            ['Arcanes',      'INT', 'Mage'],
            ['Athlétisme',   'STR', 'Guerrier'],
            ['Discrétion',   'DEX', 'Voleur'],
            ['Dressage',     'WIS', 'Ranger'],
            ['Escamotage',   'DEX', 'Voleur'],
            ['Histoire',     'INT', 'Barde'],
            ['Intimidation', 'CHA', 'Barbare'],
            ['Investigation','INT', 'Mage'],
            ['Médecine',     'WIS', 'Clerc'],
            ['Nature',       'INT', 'Druide'],
            ['Perception',   'WIS', 'Ranger'],
            ['Perspicacité', 'WIS', 'Clerc'],
            ['Persuasion',   'CHA', 'Barde'],
            ['Religion',     'INT', 'Paladin'],
            ['Représentation','CHA','Barde'],
            ['Survie',       'WIS', 'Druide'],
            ['Tromperie',    'CHA', 'Sorcier'],
        ];

        foreach ($skillsData as [$name, $ability, $className]) {
            $skill = new Skill();
            $skill->setName($name);
            $skill->setAbility($ability);
            $skill->setIdClass($classes[$className]);
            $manager->persist($skill);
        }

        // ===================== ADMIN =====================
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setEmail('admin@forge.com');
        $admin->setPassword(
            $this->passwordHasherFactory->getPasswordHasher(User::class)->hash('admin')
        );
        $manager->persist($admin);

        $manager->flush();
    }
}
