<?php

namespace MRS\InventarioBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomecompleto',null,array('label'=>'nomecompleto',
                'attr'=>array('class'=>'input-sm')))
            ->add('nome',null,array('label'=>'nome',
                'attr'=>array('class'=>'input-sm')))
            ->add('departamento',null,array('label'=>'departamento',
                'attr'=>array('class'=>'input-sm')))
            ->add('user_id',EntityType::class,array('label'=>'Acesso',
                'class' => 'MRS\UserBundle\Entity\User',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('u')
                        ->leftJoin('u.usuario','usuario')
                        ->where('usuario.user_id IS NULL')
                        ->orderBy('u.username');
                },'placeholder'=>'Selecione'))
            ->add('status',CheckboxType::class,array('label'=>'Status'))
            ->add('observacao',TextareaType::class,array('label'=>'Observação',
                'attr'=>array('class'=>'input-sm')))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\InventarioBundle\Entity\Usuario'
        ));
    }
}
