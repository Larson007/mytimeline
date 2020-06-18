<?php

namespace App\DataFixtures;

use Faker\Factory;
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
        }
        $manager->flush();
    }
}
