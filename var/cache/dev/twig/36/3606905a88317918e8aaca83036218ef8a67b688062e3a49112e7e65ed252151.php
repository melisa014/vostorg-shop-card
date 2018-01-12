<?php

/* @WebProfiler/Collector/exception.html.twig */
class __TwigTemplate_cf162f25fa3b6f82cee69ba6f883fb7c82621dcf246f7c18429b115a3511835f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/exception.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_69a213b5011775d58dee192709614e994fa4a536003a8a03beeb99413e1b691a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_69a213b5011775d58dee192709614e994fa4a536003a8a03beeb99413e1b691a->enter($__internal_69a213b5011775d58dee192709614e994fa4a536003a8a03beeb99413e1b691a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.html.twig"));

        $__internal_924909381f23d9428dbc8d6aefe7ec9e0954c470b12a806efe493535078dd968 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_924909381f23d9428dbc8d6aefe7ec9e0954c470b12a806efe493535078dd968->enter($__internal_924909381f23d9428dbc8d6aefe7ec9e0954c470b12a806efe493535078dd968_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_69a213b5011775d58dee192709614e994fa4a536003a8a03beeb99413e1b691a->leave($__internal_69a213b5011775d58dee192709614e994fa4a536003a8a03beeb99413e1b691a_prof);

        
        $__internal_924909381f23d9428dbc8d6aefe7ec9e0954c470b12a806efe493535078dd968->leave($__internal_924909381f23d9428dbc8d6aefe7ec9e0954c470b12a806efe493535078dd968_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_a42a1f3725c6b59074f9582166f34e2a7741c6f0bb3e5599c305e26e5b5e590a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_a42a1f3725c6b59074f9582166f34e2a7741c6f0bb3e5599c305e26e5b5e590a->enter($__internal_a42a1f3725c6b59074f9582166f34e2a7741c6f0bb3e5599c305e26e5b5e590a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        $__internal_337701a34fac5724130aa0fac6e2bfe0722b96255249c000506dda6a3a25e74e = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_337701a34fac5724130aa0fac6e2bfe0722b96255249c000506dda6a3a25e74e->enter($__internal_337701a34fac5724130aa0fac6e2bfe0722b96255249c000506dda6a3a25e74e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    ";
        if ($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 5
            echo "        <style>
            ";
            // line 6
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_exception_css", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
            echo "
        </style>
    ";
        }
        // line 9
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
";
        
        $__internal_337701a34fac5724130aa0fac6e2bfe0722b96255249c000506dda6a3a25e74e->leave($__internal_337701a34fac5724130aa0fac6e2bfe0722b96255249c000506dda6a3a25e74e_prof);

        
        $__internal_a42a1f3725c6b59074f9582166f34e2a7741c6f0bb3e5599c305e26e5b5e590a->leave($__internal_a42a1f3725c6b59074f9582166f34e2a7741c6f0bb3e5599c305e26e5b5e590a_prof);

    }

    // line 12
    public function block_menu($context, array $blocks = array())
    {
        $__internal_b3045e5ab8fa29830f4a255f26a3f300efecfdf2eb912ddb903fb8dec9917c1b = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_b3045e5ab8fa29830f4a255f26a3f300efecfdf2eb912ddb903fb8dec9917c1b->enter($__internal_b3045e5ab8fa29830f4a255f26a3f300efecfdf2eb912ddb903fb8dec9917c1b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        $__internal_d100ca042bb79886f0634f5617b8a468e8502abc03376fd9957bd4ba4bf258a5 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d100ca042bb79886f0634f5617b8a468e8502abc03376fd9957bd4ba4bf258a5->enter($__internal_d100ca042bb79886f0634f5617b8a468e8502abc03376fd9957bd4ba4bf258a5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 13
        echo "    <span class=\"label ";
        echo (($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) ? ("label-status-error") : ("disabled"));
        echo "\">
        <span class=\"icon\">";
        // line 14
        echo twig_include($this->env, $context, "@WebProfiler/Icon/exception.svg");
        echo "</span>
        <strong>Exception</strong>
        ";
        // line 16
        if ($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 17
            echo "            <span class=\"count\">
                <span>1</span>
            </span>
        ";
        }
        // line 21
        echo "    </span>
";
        
        $__internal_d100ca042bb79886f0634f5617b8a468e8502abc03376fd9957bd4ba4bf258a5->leave($__internal_d100ca042bb79886f0634f5617b8a468e8502abc03376fd9957bd4ba4bf258a5_prof);

        
        $__internal_b3045e5ab8fa29830f4a255f26a3f300efecfdf2eb912ddb903fb8dec9917c1b->leave($__internal_b3045e5ab8fa29830f4a255f26a3f300efecfdf2eb912ddb903fb8dec9917c1b_prof);

    }

    // line 24
    public function block_panel($context, array $blocks = array())
    {
        $__internal_0b6d350aa80a3468452d415333c220b58a288d9ebc63c6a82bc3d9299860b7d3 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_0b6d350aa80a3468452d415333c220b58a288d9ebc63c6a82bc3d9299860b7d3->enter($__internal_0b6d350aa80a3468452d415333c220b58a288d9ebc63c6a82bc3d9299860b7d3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        $__internal_c201367e38005b39151f9225898860d1bf5ec0569d32b1ac591d8e2b91dd3543 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c201367e38005b39151f9225898860d1bf5ec0569d32b1ac591d8e2b91dd3543->enter($__internal_c201367e38005b39151f9225898860d1bf5ec0569d32b1ac591d8e2b91dd3543_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 25
        echo "    <h2>Exceptions</h2>

    ";
        // line 27
        if ( !$this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 28
            echo "        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    ";
        } else {
            // line 32
            echo "        <div class=\"sf-reset\">
            ";
            // line 33
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_exception", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
            echo "
        </div>
    ";
        }
        
        $__internal_c201367e38005b39151f9225898860d1bf5ec0569d32b1ac591d8e2b91dd3543->leave($__internal_c201367e38005b39151f9225898860d1bf5ec0569d32b1ac591d8e2b91dd3543_prof);

        
        $__internal_0b6d350aa80a3468452d415333c220b58a288d9ebc63c6a82bc3d9299860b7d3->leave($__internal_0b6d350aa80a3468452d415333c220b58a288d9ebc63c6a82bc3d9299860b7d3_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 33,  135 => 32,  129 => 28,  127 => 27,  123 => 25,  114 => 24,  103 => 21,  97 => 17,  95 => 16,  90 => 14,  85 => 13,  76 => 12,  63 => 9,  57 => 6,  54 => 5,  51 => 4,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block head %}
    {% if collector.hasexception %}
        <style>
            {{ render(path('_profiler_exception_css', { token: token })) }}
        </style>
    {% endif %}
    {{ parent() }}
{% endblock %}

{% block menu %}
    <span class=\"label {{ collector.hasexception ? 'label-status-error' : 'disabled' }}\">
        <span class=\"icon\">{{ include('@WebProfiler/Icon/exception.svg') }}</span>
        <strong>Exception</strong>
        {% if collector.hasexception %}
            <span class=\"count\">
                <span>1</span>
            </span>
        {% endif %}
    </span>
{% endblock %}

{% block panel %}
    <h2>Exceptions</h2>

    {% if not collector.hasexception %}
        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    {% else %}
        <div class=\"sf-reset\">
            {{ render(path('_profiler_exception', { token: token })) }}
        </div>
    {% endif %}
{% endblock %}
", "@WebProfiler/Collector/exception.html.twig", "/var/www/vostorg-shop/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/exception.html.twig");
    }
}
