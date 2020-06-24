<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;                                               

    public function __construct(UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;                                 
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        /**** Creation d'un Role Admin ****/
        // Import de l'Entity Role
        $adminRole = new Role();
        // On défnit une valeur dans le champs title de l'Entity Role
        $adminRole->setTitle('ROLE_ADMIN');
        // On sauvegarde les données
        $manager -> persist($adminRole);

        // Création d'un user avec le Role Admin
        $adminUser = new User();
        // Les différents info du futur Admin
        $adminUser  ->setFirstName('Mohamed')
                    ->setLastName('Ben Allal')
                    ->setUserName('Moha')
                    ->setEmail('mohamed@msn.com')
                    ->setPassword($this->encoder->encodePassword($adminUser, 'password'))   // Pour le MDP, on encode avec encodePassword qui attend 2 paramettres (L'entity cible, le MDP en BRUT)
                    ->setAvatar('https://randomuser.me/api/portraits/lego/8.jpg')
                    ->addUserRole($adminRole)   //Appel de la methode addUserRole qui contient le ROLE ADMIN stocker dans $adminRole
                ;
        // On sauvegarde les données
        $manager->persist($adminUser);

        // On déclare un tableau vide $users qui contiendra les x10 $user créer
        $users = [];    
        $genres = ['male', 'female']; 
        for ($i=1; $i < 10; $i++) {

            $user = new User;

            $genre = $faker->randomElement($genres);                
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg' ;
            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId; 

            $password = $this->encoder->encodePassword($user, 'password');

            $user   ->setFirstName($faker->firstname($genre))
                    ->setLastName($faker->lastName($genre))
                    ->setUserName($faker->userName)
                    ->setEmail($faker->email)
                    ->setPassword($password)
                    ->setAvatar($picture)
                    //->setSlug('')                         // Définit dans la fonction initializeSlug de User Entity
                ;
                $manager->persist($user);
            // On place les $user dans le tableau vide $users créer précédement                               
            $users [] = $user;    
        }
        $manager->flush();
    }
}
