<?php

namespace Sy\AgendaBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sy\MainBundle\Entity\Course;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadCourse extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $course = new Course();
        $course->setName('PHP');
        $manager->persist($course);

        $manager->flush();
    }
}