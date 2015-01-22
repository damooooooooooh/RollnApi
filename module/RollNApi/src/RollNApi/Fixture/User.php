<?php

namespace RollNApi\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use RollNApi\Entity;
use ZF\OAuth2\Entity\Client as OAuth2Client;
use Zend\Crypt\Password\Bcrypt;

class User implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userFlop = false;

        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);

        $user1 = new Entity\User();
        $user1->setUsername('user1');
        $user1->setPassword($bcrypt->create('user1password'));
        $user1->setEmail('tom.h.anderson@gmail.com');
        $user1->setDisplayName('Tom Anderson');

        $manager->persist($user1);

        $client1 = new OAuth2Client();
        $client1->setClientId('client1');
        $client1->setSecret($bcrypt->create('client1password'));
        $client1->setUser($user1);

        $manager->persist($client1);

        $user2 = new Entity\User();
        $user2->setUsername('user2');
        $user2->setPassword($bcrypt->create('user2password'));
        $user2->setEmail('tom.h.anderson@gmail.com');
        $user2->setDisplayName('Tom Anderson');

        $manager->persist($user2);

        $client2 = new OAuth2Client();
        $client2->setClientId('client2');
        $client2->setSecret($bcrypt->create('client2password'));
        $client2->setUser($user2);

        $manager->persist($client2);

        // Artists
        $artist = new Entity\Artist();
        $artist->setName('Grateful Dead');

        $manager->persist($artist);

        $albums = array(
            'The Grateful Dead',
            'Anthem of the Sun',
            'Aoxomoxoa',
            'Live/Dead',
            'Workingman\'s Dead',
            'American Beauty',
        );

        foreach ($albums as $name) {
            $album = new Entity\Album();
            $album->setArtist($artist);
            $album->setName($name);

            $manager->persist($album);

            $userAlbum = new Entity\UserAlbum();
            $userAlbum->setAlbum($album);
            if ($userFlop = !$userFlop) {
                $userAlbum->setUser($user1);
            } else {
                $userAlbum->setUser($user2);
            }

            $userAlbum->setDescription("Description for $name");

            $manager->persist($userAlbum);
        }

        $manager->flush();
    }
}
