<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_3af4a99c1cb655a4825f0a6e01551d674b52d52b622e47d73e3845cb1496152a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
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
        $__internal_e68b26ad297b3b320745589b67126fc3b2ef70e53ec71158f3e32f182f15bb75 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_e68b26ad297b3b320745589b67126fc3b2ef70e53ec71158f3e32f182f15bb75->enter($__internal_e68b26ad297b3b320745589b67126fc3b2ef70e53ec71158f3e32f182f15bb75_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $__internal_4bc41bede8e1ae86a86b276346491bcd1b5f80de3e915a9880573e1a0cfbf449 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4bc41bede8e1ae86a86b276346491bcd1b5f80de3e915a9880573e1a0cfbf449->enter($__internal_4bc41bede8e1ae86a86b276346491bcd1b5f80de3e915a9880573e1a0cfbf449_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e68b26ad297b3b320745589b67126fc3b2ef70e53ec71158f3e32f182f15bb75->leave($__internal_e68b26ad297b3b320745589b67126fc3b2ef70e53ec71158f3e32f182f15bb75_prof);

        
        $__internal_4bc41bede8e1ae86a86b276346491bcd1b5f80de3e915a9880573e1a0cfbf449->leave($__internal_4bc41bede8e1ae86a86b276346491bcd1b5f80de3e915a9880573e1a0cfbf449_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_319fd46ef49b5df11815bf2c269b326c3edd1afb7caa0e48be92804d71721155 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_319fd46ef49b5df11815bf2c269b326c3edd1afb7caa0e48be92804d71721155->enter($__internal_319fd46ef49b5df11815bf2c269b326c3edd1afb7caa0e48be92804d71721155_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_e786deb8ca8d5f5e39208c699bab074eac4015a906601b12635615ff4a6d6059 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e786deb8ca8d5f5e39208c699bab074eac4015a906601b12635615ff4a6d6059->enter($__internal_e786deb8ca8d5f5e39208c699bab074eac4015a906601b12635615ff4a6d6059_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_e786deb8ca8d5f5e39208c699bab074eac4015a906601b12635615ff4a6d6059->leave($__internal_e786deb8ca8d5f5e39208c699bab074eac4015a906601b12635615ff4a6d6059_prof);

        
        $__internal_319fd46ef49b5df11815bf2c269b326c3edd1afb7caa0e48be92804d71721155->leave($__internal_319fd46ef49b5df11815bf2c269b326c3edd1afb7caa0e48be92804d71721155_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_cc07f167a9ab1178f891cb8682df0d765d9dcae4f986e98e98fccdf24b47a9de = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_cc07f167a9ab1178f891cb8682df0d765d9dcae4f986e98e98fccdf24b47a9de->enter($__internal_cc07f167a9ab1178f891cb8682df0d765d9dcae4f986e98e98fccdf24b47a9de_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        $__internal_3153f35d101082d828580d4c526b4165799ed3cec3504d102ae5001723c69d7e = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3153f35d101082d828580d4c526b4165799ed3cec3504d102ae5001723c69d7e->enter($__internal_3153f35d101082d828580d4c526b4165799ed3cec3504d102ae5001723c69d7e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_3153f35d101082d828580d4c526b4165799ed3cec3504d102ae5001723c69d7e->leave($__internal_3153f35d101082d828580d4c526b4165799ed3cec3504d102ae5001723c69d7e_prof);

        
        $__internal_cc07f167a9ab1178f891cb8682df0d765d9dcae4f986e98e98fccdf24b47a9de->leave($__internal_cc07f167a9ab1178f891cb8682df0d765d9dcae4f986e98e98fccdf24b47a9de_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_66739bcaea4cf05fe384d17340a99144481c2b345c4357fb4f5629b12200a222 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_66739bcaea4cf05fe384d17340a99144481c2b345c4357fb4f5629b12200a222->enter($__internal_66739bcaea4cf05fe384d17340a99144481c2b345c4357fb4f5629b12200a222_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        $__internal_eeba3ed4fb8a5816a80c9ed835ffd51a51cd620baef986a2ac60a4bf18fe1612 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_eeba3ed4fb8a5816a80c9ed835ffd51a51cd620baef986a2ac60a4bf18fe1612->enter($__internal_eeba3ed4fb8a5816a80c9ed835ffd51a51cd620baef986a2ac60a4bf18fe1612_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_eeba3ed4fb8a5816a80c9ed835ffd51a51cd620baef986a2ac60a4bf18fe1612->leave($__internal_eeba3ed4fb8a5816a80c9ed835ffd51a51cd620baef986a2ac60a4bf18fe1612_prof);

        
        $__internal_66739bcaea4cf05fe384d17340a99144481c2b345c4357fb4f5629b12200a222->leave($__internal_66739bcaea4cf05fe384d17340a99144481c2b345c4357fb4f5629b12200a222_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 13,  85 => 12,  71 => 7,  68 => 6,  59 => 5,  42 => 3,  11 => 1,);
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

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "/var/www/vostorg-shop/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/router.html.twig");
    }
}
