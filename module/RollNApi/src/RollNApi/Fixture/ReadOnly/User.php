<?php

namespace RollNApi\Fixture\ReadOnly;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use RollNApi\Entity;
use ZF\OAuth2\Entity\Client as OAuth2Client;
use ZF\OAuth2\Entity\Scope as OAuth2Scope;
use ZF\OAuth2\Entity\Jwt as OAuth2Jwt;
use ZF\OAuth2\Entity\Jti as OAuth2Jti;
use Zend\Crypt\Password\Bcrypt;
use DateTime;

class User implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userFlop = false;

        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);

        $scope1 = new OAuth2Scope();
        $scope1->setScope('read');
        $scope1->setIsDefault(true);

        $manager->persist($scope1);

        $scope2 = new OAuth2Scope();
        $scope2->setScope('update');
        $scope2->setIsDefault(false);

        $manager->persist($scope2);

        $scope3 = new OAuth2Scope();
        $scope3->setScope('delete');
        $scope3->setIsDefault(false);

        $manager->persist($scope3);

        $scope4 = new OAuth2Scope();
        $scope4->setScope('create');
        $scope4->setIsDefault(false);

        $manager->persist($scope4);

        $user2 = new Entity\User();
        $user2->setUsername('user2');
        $user2->setPassword($bcrypt->create('user2password'));
        $user2->setEmail('tom.h.anderson@gmail.com');
        $user2->setDisplayName('Tom Anderson');

        $manager->persist($user2);

        $client2 = new OAuth2Client();
        $client2->setClientId('readonly');
        $client2->setSecret($bcrypt->create('readonly_password'));
        $client2->setGrantType(array('client_credentials', 'refresh_token'));
        $client2->setUser($user2);

        $client2->addScope($scope1);
        $scope1->addClient($client2);

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
#                $userAlbum->setUser($user1);
            } else {
                $userAlbum->setUser($user2);
            }

            $userAlbum->setDescription("Description for $name");

            $manager->persist($userAlbum);
        }

        $loop = new Entity\TestLoop();
        $loop->setParentLoop($loop);

        $manager->persist($loop);

        $manager->flush();
    }
}
