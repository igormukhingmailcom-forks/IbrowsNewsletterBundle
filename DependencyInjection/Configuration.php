<?php

namespace Ibrows\Bundle\NewsletterBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('ibrows_newsletter');

		$rootNode
			->addDefaultsIfNotSet()
				->children()
					->scalarNode('db_driver')->defaultValue('orm')->end()
				->end()
		;
		
		$this->addTemplatesSection($rootNode);
		$this->addClassesSection($rootNode);

		return $treeBuilder;
	}
	
	public function addTemplatesSection(ArrayNodeDefinition $node)
	{
		$node
			->children()
				->arrayNode('templates')
					->addDefaultsIfNotSet()
					->children()
						->arrayNode('client')
							->addDefaultsIfNotSet()
							->children()
								->scalarNode('index')->defaultValue('IbrowsNewsletterBundle:Client:index.html.twig')->end()
								->scalarNode('edit')->defaultValue('IbrowsNewsletterBundle:Client:edit.html.twig')->end()
								->scalarNode('create')->defaultValue('IbrowsNewsletterBundle:Client:create.html.twig')->end()
								->scalarNode('send')->defaultValue('IbrowsNewsletterBundle:Client:send.html.twig')->end()
								->scalarNode('summary')->defaultValue('IbrowsNewsletterBundle:Client:summary.html.twig')->end()
							->end()
						->end()
						->arrayNode('newsletter')
							->addDefaultsIfNotSet()
							->children()
								->scalarNode('index')->defaultValue('IbrowsNewsletterBundle:Newsletter:index.html.twig')->end()
								->scalarNode('edit')->defaultValue('IbrowsNewsletterBundle:Newsletter:edit.html.twig')->end()
								->scalarNode('create')->defaultValue('IbrowsNewsletterBundle:Newsletter:create.html.twig')->end()
								->scalarNode('send')->defaultValue('IbrowsNewsletterBundle:Newsletter:send.html.twig')->end()
								->scalarNode('summary')->defaultValue('IbrowsNewsletterBundle:Newsletter:summary.html.twig')->end()
							->end()
						->end()
					->end()
				->end()
			->end()
		;
	}
	
	public function addClassesSection(ArrayNodeDefinition $node)
	{
		$node->children()
				->arrayNode('classes')->children()
						->arrayNode('model')
							->children()
								->scalarNode('newsletter')->isRequired()->cannotBeEmpty()->end()
								->scalarNode('client')->isRequired()->cannotBeEmpty()->end()
								->scalarNode('subscriber')->isRequired()->cannotBeEmpty()->end()
							->end()
						->end()
						->arrayNode('form')
							->addDefaultsIfNotSet()
							->children()
								->scalarNode('newsletter_meta')->defaultValue('Ibrows\\Bundle\\NewsletterBundle\\Form\\NewsletterMetaType')->end()
								->scalarNode('newsletter_content')->defaultValue('Ibrows\\Bundle\\NewsletterBundle\\Form\\NewsletterContentType')->end()
								->scalarNode('subscriber')->defaultValue('Ibrows\\Bundle\\NewsletterBundle\\Form\\SubscriberType')->end()
							->end()
						->end()
				->end()
			->end()
		;
	}

}