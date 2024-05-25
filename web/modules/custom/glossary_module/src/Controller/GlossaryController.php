<?php
namespace Drupal\glossary_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Core\Url;
use Drupal\glossary_module\GlossaryModuleService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GlossaryController extends ControllerBase {

  protected $glossaryModuleService;

  public function __construct(GlossaryModuleService $glossaryModuleService) {
    $this->glossaryModuleService = $glossaryModuleService;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('glossary_module.service')
    );
  }

  public function render() {
    $content = $this->glossaryModuleService->getProcessedContent();

        return [
            '#theme' => 'page--glossary_module',
            '#content' => $content,
            '#attached' => [
              'library' => ['glossary_module/glossary_style'],
            ],
          ];
      }
  }
