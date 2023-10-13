<?php
declare(strict_types=1);

namespace JeffAdmin5\View;

/**
 * UIViewTrait: Trait that loads the custom UIBootstrap helpers and sets View
 * layout to the UIBootstrap's one.
 */
trait JAViewTrait
{
    /**
     * Initialization hook method.
     *
     * @param array $options Associative array with valid keys:
     *   - `layout`:
     *      - If not set or true will use the plugin's layout
     *      - If a layout name passed it will be used
     *      - If false do nothing (will keep your layout)
     * @return void
     */
    public function initializeJA(array $options = []): void
    {
        if (
            (!isset($options['layout']) || $options['layout'] === true) &&
            $this->layout === 'default'
        ) {
            $this->layout = 'JeffAdmin5.default';
        } elseif (isset($options['layout']) && is_string($options['layout'])) {
            $this->layout = $options['layout'];
        }

        $helpers = [
            //'Html' => ['className' => 'BootstrapUI.Html'],
            'Form' => ['className' => 'JeffAdmin5.Form'],
            //'Flash' => ['className' => 'BootstrapUI.Flash'],
            //'Paginator' => ['className' => 'BootstrapUI.Paginator'],
            //'Breadcrumbs' => ['className' => 'BootstrapUI.Breadcrumbs'],
        ];

        $this->helpers = array_merge($helpers, $this->helpers);
    }
}
