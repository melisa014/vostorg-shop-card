<?php

/* base.html.twig */
class __TwigTemplate_e7512925d8fb00307cc049a1006d437f3028b1723b810d6e2acede88a13e1891 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b8719ae9c0f6a51a9e45d66c499e70026deb185cc99333872ff2673a45f876ec = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_b8719ae9c0f6a51a9e45d66c499e70026deb185cc99333872ff2673a45f876ec->enter($__internal_b8719ae9c0f6a51a9e45d66c499e70026deb185cc99333872ff2673a45f876ec_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_9c7e5b67e72faf1350ada90289297eb293640ad84e5aac31965c7f4e27619531 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_9c7e5b67e72faf1350ada90289297eb293640ad84e5aac31965c7f4e27619531->enter($__internal_9c7e5b67e72faf1350ada90289297eb293640ad84e5aac31965c7f4e27619531_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_b8719ae9c0f6a51a9e45d66c499e70026deb185cc99333872ff2673a45f876ec->leave($__internal_b8719ae9c0f6a51a9e45d66c499e70026deb185cc99333872ff2673a45f876ec_prof);

        
        $__internal_9c7e5b67e72faf1350ada90289297eb293640ad84e5aac31965c7f4e27619531->leave($__internal_9c7e5b67e72faf1350ada90289297eb293640ad84e5aac31965c7f4e27619531_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_2a4aa553b0ce3ec4c7110a88f0850ce620854bd2ac5d242a409f19020c02c1f1 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_2a4aa553b0ce3ec4c7110a88f0850ce620854bd2ac5d242a409f19020c02c1f1->enter($__internal_2a4aa553b0ce3ec4c7110a88f0850ce620854bd2ac5d242a409f19020c02c1f1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_ba881af0755305be88f691cbd058110b1c0c9de80fd9464f6d715eef6f860959 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ba881af0755305be88f691cbd058110b1c0c9de80fd9464f6d715eef6f860959->enter($__internal_ba881af0755305be88f691cbd058110b1c0c9de80fd9464f6d715eef6f860959_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_ba881af0755305be88f691cbd058110b1c0c9de80fd9464f6d715eef6f860959->leave($__internal_ba881af0755305be88f691cbd058110b1c0c9de80fd9464f6d715eef6f860959_prof);

        
        $__internal_2a4aa553b0ce3ec4c7110a88f0850ce620854bd2ac5d242a409f19020c02c1f1->leave($__internal_2a4aa553b0ce3ec4c7110a88f0850ce620854bd2ac5d242a409f19020c02c1f1_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_77bd2178862ef5c582503fb78f91b9a5ed340246bead0868cb71a8feb5246867 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_77bd2178862ef5c582503fb78f91b9a5ed340246bead0868cb71a8feb5246867->enter($__internal_77bd2178862ef5c582503fb78f91b9a5ed340246bead0868cb71a8feb5246867_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_4b8162935722c5513ce19cfeedf3f7bc2a03a77eb4878ed28a52ac66479a4395 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4b8162935722c5513ce19cfeedf3f7bc2a03a77eb4878ed28a52ac66479a4395->enter($__internal_4b8162935722c5513ce19cfeedf3f7bc2a03a77eb4878ed28a52ac66479a4395_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_4b8162935722c5513ce19cfeedf3f7bc2a03a77eb4878ed28a52ac66479a4395->leave($__internal_4b8162935722c5513ce19cfeedf3f7bc2a03a77eb4878ed28a52ac66479a4395_prof);

        
        $__internal_77bd2178862ef5c582503fb78f91b9a5ed340246bead0868cb71a8feb5246867->leave($__internal_77bd2178862ef5c582503fb78f91b9a5ed340246bead0868cb71a8feb5246867_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_3c54162210839132201e1e9c8d2f4d2ac0391ad1cfe4d00831dd2e52826caba3 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_3c54162210839132201e1e9c8d2f4d2ac0391ad1cfe4d00831dd2e52826caba3->enter($__internal_3c54162210839132201e1e9c8d2f4d2ac0391ad1cfe4d00831dd2e52826caba3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_5ac49d85d3d2e60f310ce928351e2bed7f7c4c78da0100d2d66df80c43158898 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5ac49d85d3d2e60f310ce928351e2bed7f7c4c78da0100d2d66df80c43158898->enter($__internal_5ac49d85d3d2e60f310ce928351e2bed7f7c4c78da0100d2d66df80c43158898_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_5ac49d85d3d2e60f310ce928351e2bed7f7c4c78da0100d2d66df80c43158898->leave($__internal_5ac49d85d3d2e60f310ce928351e2bed7f7c4c78da0100d2d66df80c43158898_prof);

        
        $__internal_3c54162210839132201e1e9c8d2f4d2ac0391ad1cfe4d00831dd2e52826caba3->leave($__internal_3c54162210839132201e1e9c8d2f4d2ac0391ad1cfe4d00831dd2e52826caba3_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_fc181e0968c4821b5ed46f79a176d60b38bf5e146f04259cfaf1b17997f8fa06 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_fc181e0968c4821b5ed46f79a176d60b38bf5e146f04259cfaf1b17997f8fa06->enter($__internal_fc181e0968c4821b5ed46f79a176d60b38bf5e146f04259cfaf1b17997f8fa06_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_a204ba3412adc6f83e2c9efa90778c161890c57ca67796b64d38a36758f3fd7a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a204ba3412adc6f83e2c9efa90778c161890c57ca67796b64d38a36758f3fd7a->enter($__internal_a204ba3412adc6f83e2c9efa90778c161890c57ca67796b64d38a36758f3fd7a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_a204ba3412adc6f83e2c9efa90778c161890c57ca67796b64d38a36758f3fd7a->leave($__internal_a204ba3412adc6f83e2c9efa90778c161890c57ca67796b64d38a36758f3fd7a_prof);

        
        $__internal_fc181e0968c4821b5ed46f79a176d60b38bf5e146f04259cfaf1b17997f8fa06->leave($__internal_fc181e0968c4821b5ed46f79a176d60b38bf5e146f04259cfaf1b17997f8fa06_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 11,  100 => 10,  83 => 6,  65 => 5,  53 => 12,  50 => 11,  48 => 10,  41 => 7,  39 => 6,  35 => 5,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "base.html.twig", "/var/www/vostorg-shop/app/Resources/views/base.html.twig");
    }
}
