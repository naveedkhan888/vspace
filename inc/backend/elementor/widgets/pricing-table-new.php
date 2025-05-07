<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Pricing Table New
 * Description: A premium pricing table widget for Elementor with multiple styles and customization options
 */
class Xhub_Pricing_Table_New extends Widget_Base
{
    /**
     * Get widget name.
     *
     */
    public function get_name()
    {
        return 'ipricingtablenew';
    }

    /**
     * Get widget title.
     *
     */
    public function get_title()
    {
        return esc_html__('Pricing Table New', 'xhub');
    }

    /**
     * Get widget icon.
     *
     */
    public function get_icon()
    {
        return 'eicon-price-table';
    }

    /**
     * Get widget categories.
     *
     */
    public function get_categories()
    {
        return ['xhub-elements'];
    }

    /**
     * Get widget keywords.
     *
     */
    public function get_keywords()
    {
        return ['pricing', 'price', 'table', 'package', 'product', 'plan'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
    }

    /**
     * Register content controls for the widget.
     */
    protected function register_content_controls()
    {
        // Design Style Section
        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => esc_html__('Design Style', 'xhub'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__('Design Style', 'xhub'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => esc_html__('Style 1', 'xhub'),
                    'style_2' => esc_html__('Style 2', 'xhub'),
                    'style_3' => esc_html__('Style 3', 'xhub'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'active_price',
            [
                'label' => esc_html__('Active Price', 'xhub'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'xhub'),
                'label_off' => esc_html__('Hide', 'xhub'),
                'return_value' => 'yes',
                'default' => '',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Icon / Image Section
        $this->start_controls_section(
            '_section_media',
            [
                'label' => esc_html__('Icon / Image', 'xhub'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__('Media Type', 'xhub'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'xhub'),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'xhub'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'xhub'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'xhub'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->end_controls_section();

        // Header Section
        $this->start_controls_section(
            '_section_header',
            [
                'label' => esc_html__('Header', 'xhub'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Basic', 'xhub'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Sub Title', 'xhub'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('MBPS', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('MBPS', 'xhub'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->end_controls_section();

        // Devices Section
        $this->start_controls_section(
            '_section_devices',
            [
                'label' => esc_html__('Devices', 'xhub'),
                'condition' => [
                    'design_style' => ['style_2'],
                ]
            ]
        );

        $this->add_control(
            'devices_switch',
            [
                'label' => esc_html__('Show', 'xhub'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'xhub'),
                'label_off' => esc_html__('Hide', 'xhub'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'selected_icon_2',
            [
                'label' => esc_html__('Icon', 'xhub'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-regular' => [
                        'check-square',
                        'window-close',
                    ],
                    'fa-solid' => [
                        'check',
                    ]
                ]
            ]
        );

        $this->add_control(
            'devices',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'selected_icon_2' => [
                            'value' => 'fas fa-laptop',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'selected_icon_2' => [
                            'value' => 'fas fa-mobile-alt',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '<i class="{{ selected_icon_2.value }}"></i>',
            ]
        );

        $this->end_controls_section();

        // Pricing Section
        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => esc_html__('Pricing', 'xhub'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'xhub'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => esc_html__('None', 'xhub'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'xhub'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'xhub'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'xhub'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'xhub'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'xhub'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'xhub'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'xhub'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'xhub'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'xhub'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'xhub'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'xhub'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'xhub'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'xhub'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'xhub'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'xhub'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'xhub'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'xhub'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'xhub'),
                    'custom' => esc_html__('Custom', 'xhub'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'period_from',
            [
                'label' => esc_html__('Start From', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Start From', 'xhub'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__('Custom Symbol', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__('Period', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Per Month', 'xhub'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        // Features Section
        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__('Features', 'xhub'),
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ]
            ]
        );

        $this->add_control(
            'features_switch',
            [
                'label' => esc_html__('Show', 'xhub'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'xhub'),
                'label_off' => esc_html__('Hide', 'xhub'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'xhub'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Exciting Feature', 'xhub'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'xhub'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-regular' => [
                        'check-square',
                        'window-close',
                    ],
                    'fa-solid' => [
                        'check',
                    ]
                ]
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__('Standard Feature', 'xhub'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'text' => esc_html__('Another Great Feature', 'xhub'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'text' => esc_html__('Exciting Feature', 'xhub'),
                        'selected_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        // Price Footer Section
        $this->start_controls_section(
            '_section_footer',
            [
                'label' => esc_html__('Price Footer', 'xhub'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subscribe', 'xhub'),
                'placeholder' => esc_html__('Type button text here', 'xhub'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'xhub'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'https://yourwebsite.com/',
                'default' => [
                    'url' => '#',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Badge Section
        $this->start_controls_section(
            '_section_badge',
            [
                'label' => esc_html__('Badge', 'xhub'),
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => esc_html__('Show', 'xhub'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'xhub'),
                'label_off' => esc_html__('Hide', 'xhub'),
                'return_value' => 'yes',
                'default' => '',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label' => esc_html__('Position', 'xhub'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'xhub'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'xhub'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'right',
                'style_transfer' => true,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'xhub'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Recommended', 'xhub'),
                'placeholder' => esc_html__('Type badge text', 'xhub'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register style controls for the widget.
     */
    protected function register_style_controls()
    {
        // General Style Section
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__('General', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-currency,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-period,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-features-title,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-features-list li,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_shape_color',
            [
                'label' => esc_html__('Shape Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price__shape' => 'border-color: transparent {{VALUE}} transparent transparent;',
                ],
            ]
        );

        $this->add_control(
            'price_border_color',
            [
                'label' => esc_html__('Border Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price__item' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-item' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-three-item' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-two-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_table_background',
                'label' => esc_html__('Background', 'xhub'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pricing-item, {{WRAPPER}} .pricing-three-item, {{WRAPPER}} .pricing-two-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_table_box_shadow',
                'label' => esc_html__('Box Shadow', 'xhub'),
                'selector' => '{{WRAPPER}} .pricing-item, {{WRAPPER}} .pricing-three-item, {{WRAPPER}} .pricing-two-item',
            ]
        );

        $this->add_responsive_control(
            'pricing_table_border_radius',
            [
                'label' => esc_html__('Border Radius', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-three-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-two-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Header Style Section
        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__('Header', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-title',
            ]
        );

        $this->end_controls_section();

        // Pricing Style Section
        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => esc_html__('Pricing', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Price', 'xhub'),
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-three-price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-price-text, {{WRAPPER}} .pricing-three-price, {{WRAPPER}} .price',
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Currency', 'xhub'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => esc_html__('Side Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-currency' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .price sup' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-three-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-currency, {{WRAPPER}} .price sup',
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Period', 'xhub'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-period',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add controls for features styling.
     *
     */
    protected function add_features_style_controls() {
        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => esc_html__('Features', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Container Spacing
        $this->add_responsive_control(
            'features_container_spacing',
            [
                'label' => esc_html__('Container Bottom Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Features Title Heading
        $this->add_control(
            '_heading_features_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'xhub'),
                'separator' => 'before',
            ]
        );

        // Title Bottom Spacing
        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title Text Color
        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-features-title',
            ]
        );

        // Features List Heading
        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('List', 'xhub'),
                'separator' => 'before',
            ]
        );

        // List Item Spacing
        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => esc_html__('Spacing Between', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // List Item Text Color
        $this->add_control(
            'features_list_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        // List Item Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-features-list > li',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add controls for footer styling.
     *
     */
    protected function add_footer_style_controls() {
        $this->start_controls_section(
            '_section_style_footer',
            [
                'label' => esc_html__('Footer', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Button Heading
        $this->add_control(
            '_heading_button',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Button', 'xhub'),
            ]
        );

        // Button Padding
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
            ]
        );

        // Button Border Radius
        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Box Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
            ]
        );

        // Button Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
            ]
        );

        // Divider
        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        // Button State Tabs
        $this->start_controls_tabs('_tabs_button');

        // Normal Tab
        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__('Normal', 'xhub'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'xhub'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_before_bg_color',
            [
                'label' => esc_html__('Hover Before BG Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s-btn.transparent-btn.bdevs-el-btn:hover:before, {{WRAPPER}} .s-btn.transparent-btn.bdevs-el-btn:focus:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Add controls for badge styling.
     *
     */
    protected function add_badge_style_controls() {
        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__('Badge', 'xhub'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Badge Padding
        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => esc_html__('Padding', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Badge Text Color
        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__('Text Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Badge Background Color
        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__('Background Color', 'xhub'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Badge Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
            ]
        );

        // Badge Border Radius
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Badge Box Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
            ]
        );

        // Badge Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__('Typography', 'xhub'),
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
            ]
        );

        $this->end_controls_section();
    }

    private static function get_currency_symbol($symbol_name) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function get_currency_html($settings) {
        if (empty($settings['currency'])) {
            return '';
        }

        if ($settings['currency'] === 'custom') {
            return isset($settings['currency_custom']) ? $settings['currency_custom'] : '';
        }

        return self::get_currency_symbol($settings['currency']);
    }

    

    /**
     * Render the widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Add editing attributes and CSS classes
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'item_title');
        $this->add_render_attribute('sub_title', 'class', 'sub_title');
        $this->add_inline_editing_attributes('price', 'basic');
        $this->add_render_attribute('price', 'class', 'pricing_text');
        $this->add_inline_editing_attributes('period', 'basic');
        $this->add_render_attribute('period', 'class', 'price-period');
        $this->add_inline_editing_attributes('features_title', 'basic');
        $this->add_render_attribute('features_title', 'class', 'price-featured mb-20');

        // Get currency symbol
        $currency = '';
        if (isset($settings['currency'])) {
            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'] ?? '';
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }
        }

        // Determine which template to render based on design style
        if (isset($settings['design_style'])) {
            switch ($settings['design_style']) {
                case 'style_3':
                    $this->render_style_3($settings, $currency);
                    break;
                case 'style_2':
                    $this->render_style_2($settings, $currency);
                    break;
                default:
                    $this->render_style_1($settings, $currency);
                    break;
            }
        } else {
            $this->render_style_1($settings, $currency);
        }
    }

    /**
     * Render Style 3 template
     *
     */
    private function render_style_3($settings, $currency) {
        ?>
        <div class="pricing-two-item">
            <div class="pricing-two-content">
                <?php if (!empty($settings['title'])) : ?>
                    <h3 class="title bdevselement-pricing-table-title"><?php echo wp_kses_post($settings['title']); ?></h3>
                <?php endif; ?>
                
                <?php if (!empty($settings['sub_title'])) : ?>
                    <p><?php echo wp_kses_post($settings['sub_title']); ?></p>
                <?php endif; ?>

                <h3 class="price bdevselement-pricing-table-period">
                    <sup><?php echo esc_html($currency); ?></sup>
                    <?php echo wp_kses_post($settings['price'] ?? ''); ?>
                    <span>
                        <?php echo wp_kses_post($settings['period_from'] ?? ''); ?> <br> 
                        <?php echo wp_kses_post($settings['period'] ?? ''); ?>
                    </span>
                </h3>
                
                <?php if (!empty($settings['button_text'])) : ?>
                    <div class="pricing-btn">
                        <a href="<?php echo esc_url($settings['button_link']['url'] ?? '#'); ?>" 
                           class="btn s-btn btn-link bdevselement-pricing-table-btn">
                            <?php echo wp_kses_post($settings['button_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render Style 2 template
     *
     */
    private function render_style_2($settings, $currency) {
        $class_name = !empty($settings['active_price']) ? 'active' : '';
        ?>
        <div class="pricing-three-item mb-30 <?php echo esc_attr($class_name); ?>">
            <div class="pricing-three-head">
                <?php if (!empty($settings['title'])) : ?>
                    <h4 class="title bdevselement-pricing-table-title"><?php echo wp_kses_post($settings['title']); ?></h4>
                <?php endif; ?>

                <?php if (!empty($settings['sub_title'])) : ?>
                    <span class="devices-support"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                <?php endif; ?>

                <?php if (!empty($settings['devices'])) : ?>
                    <ul class="devices-icon-wrap">
                        <?php foreach ($settings['devices'] as $device) : ?>
                            <li>
                                <?php 
                                if (!empty($device['icon_2']) || !empty($device['selected_icon_2']['value'])) :
                                    Icons_Manager::render_icon($device, 'icon_2', 'selected_icon_2');
                                endif; 
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if (!empty($settings['features_switch']) && !empty($settings['features_list'])) : ?>
                <div class="pricing-three-list netfix_pricing_before_disable bdevselement-pricing-table-features-list">
                    <ul>
                        <?php foreach ($settings['features_list'] as $feature) : ?>
                            <li>
                                <?php 
                                if (!empty($feature['icon']) || !empty($feature['selected_icon']['value'])) :
                                    Icons_Manager::render_icon($feature, 'icon', 'selected_icon');
                                endif; 
                                ?>
                                <?php echo wp_kses_post($feature['text'] ?? ''); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <h2 class="pricing-three-price bdevselement-pricing-table-period">
                <?php if (!empty($settings['period_from'])) : ?>
                    <span><?php echo wp_kses_post($settings['period_from']); ?></span>
                <?php endif; ?>
                <?php echo esc_html($currency); ?><?php echo wp_kses_post($settings['price'] ?? ''); ?>
                <span><?php echo wp_kses_post($settings['period'] ?? ''); ?></span>
            </h2>
            
            <?php if (!empty($settings['button_text'])) : ?>
                <a href="<?php echo esc_url($settings['button_link']['url'] ?? '#'); ?>" 
                   class="btn s-btn transparent-btn bdevselement-pricing-table-btn">
                    <?php echo wp_kses_post($settings['button_text']); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render Style 1 (default) template
     *
     */
    private function render_style_1($settings, $currency) {
        $class_name = !empty($settings['active_price']) ? 'active' : '';

        // Setup button attributes
        $this->add_inline_editing_attributes('button_footer', 'none');
        $this->add_render_attribute('button_footer', 'class', 'price-btn');
        if (!empty($settings['button_link'])) {
            $this->add_link_attributes('button_footer', $settings['button_link']);
        }
        ?>
        <div class="pricing-item mb-30 <?php echo esc_attr($class_name); ?>">
            <div class="pricing-thumb">
                <?php if (!empty($settings['image']['id']) && isset($settings['type']) && $settings['type'] === 'image') : ?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                <?php else : ?>
                    <?php Icons_Manager::render_icon($settings, 'icon', 'selected_icon'); ?>
                <?php endif; ?>

                <?php if (!empty($settings['title'])) : ?>
                    <h3 class="title bdevselement-pricing-table-title"><?php echo wp_kses_post($settings['title']); ?></h3>
                <?php endif; ?>
                
                <div class="net-speed">
                    <?php if (!empty($settings['sub_title'])) : ?>
                        <h5>
                            <?php echo wp_kses_post($settings['sub_title']); ?>
                            <?php if (!empty($settings['description'])) : ?>
                                <span><?php echo wp_kses_post($settings['description']); ?></span>
                            <?php endif; ?>
                        </h5>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="pricing-content">
                <?php if (!empty($settings['features_switch']) && !empty($settings['features_list'])) : ?>
                    <ul class="pricing-list bdevselement-pricing-table-features-list">
                        <?php foreach ($settings['features_list'] as $feature) : ?>
                            <li>
                                <?php 
                                if (!empty($feature['icon']) || !empty($feature['selected_icon']['value'])) :
                                    Icons_Manager::render_icon($feature, 'icon', 'selected_icon');
                                endif; 
                                ?> 
                                <?php echo wp_kses_post($feature['text'] ?? ''); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <div class="price-wrap">
                    <?php if (!empty($settings['period_from'])) : ?>
                        <span><?php echo wp_kses_post($settings['period_from']); ?></span>
                    <?php endif; ?>
                    
                    <h3 class="price bdevselement-pricing-table-period">
                        <?php echo esc_html($currency); ?>
                        <?php echo wp_kses_post($settings['price'] ?? ''); ?>
                        <sub><?php echo wp_kses_post($settings['period'] ?? ''); ?></sub>
                    </h3>
                </div>
                
                <?php if (!empty($settings['button_text'])) : ?>
                    <div class="pricing-btn">
                        <a href="<?php echo esc_url($settings['button_link']['url'] ?? '#'); ?>" 
                           class="btn s-btn btn-link bdevselement-pricing-table-btn">
                            <?php echo wp_kses_post($settings['button_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}


Plugin::instance()->widgets_manager->register( new Xhub_Pricing_Table_New() );