<?php

namespace VendorWeather\WeatherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegionType extends AbstractType
{
    /*
    * @param FormBuilderInterface $builder
    * @param array $options
    */
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder
           ->add('nom', TextType::class, array('required' => true))
           ->add('temperature', TextType::class, array('required' => true))
           ->add('commentaire', TextType::class, array('required' => true)) ;        
   }

   /**
    * @param OptionsResolver $resolver
    */
   public function configureOptions(OptionsResolver $resolver)
   {
       $resolver->setDefaults(array(
           'data_class' => 'VendorWeather\WeatherBundle\Entity\Region'
       ));
   }
}