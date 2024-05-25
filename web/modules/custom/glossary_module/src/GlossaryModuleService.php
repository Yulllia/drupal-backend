<?php

namespace Drupal\glossary_module;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\Component\Utility\Html;

class GlossaryModuleService {

  protected $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function getProcessedContent() {
    $nodes = $this->entityTypeManager
      ->getStorage('node')
      ->loadByProperties(['type' => 'page']);

    if (empty($nodes)) {
      return 'No content available.';
    }

    $node = reset($nodes);
    if (!$node instanceof NodeInterface) {
      return 'No valid node found.';
    }

    $body = $node->get('body')->value;
    $title = $node->label();

    $processedContent = $this->processGlossaryTerms($body);

    return [
        'title' => $title,
        'description' => $processedContent,
      ];
  }

  protected function processGlossaryTerms($body) {
    $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadTree('glossary_terms');

    foreach ($terms as $term) {
      $term_entity = Term::load($term->tid);
      $description = $term_entity->get('field_glossary_description')->value;

      if (strlen($description) > 100) {
        $tooltip_text = substr($description, 0, 100) . '...';
      } else {
        $tooltip_text = $description;
      }

      $pattern = '/\b' . preg_quote($term->name, '/') . '\b/i';
      $replacement = '<span class="glossary-term" data-toggle="tooltip" data-description="' . htmlspecialchars($tooltip_text) . '" data-link="/taxonomy/term/' . $term->tid . '">' . $term->name . '</span>';
      $body = preg_replace($pattern, $replacement, $body);
    }

    return $body;
  }
}
?>