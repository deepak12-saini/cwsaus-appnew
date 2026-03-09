<?php

/* @galleries/gallery_preset.twig */
class __TwigTemplate_9fa163b8a7c763ab1778c6f5d0ace67fb5fb85758d55c620e909c6e5a81a624f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("grid-gallery.twig", "@galleries/gallery_preset.twig", 1);
        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "grid-gallery.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_header($context, array $blocks = array())
    {
        // line 27
        echo "    <nav id=\"supsystic-breadcrumbs\" class=\"supsystic-breadcrumbs\">
        <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "generateUrl", array(0 => "galleries"), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Gallery by Supsystic")), "html", null, true);
        echo "</a>
        <i class=\"fa fa-angle-right\"></i>
        <a href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "generateUrl", array(0 => "galleries", 1 => "showPresets"), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create new gallery")), "html", null, true);
        echo "</a>
    </nav>
";
    }

    // line 34
    public function block_content($context, array $blocks = array())
    {
        // line 35
        echo "    <h3 style=\"margin-left: 10px;padding-bottom: 10px !important;border-bottom: 1px solid;\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Choose Gallery Template. You can change template and settings on the next step.")), "html", null, true);
        echo "</h3>
    <div id=\"gg-create-gallery-text\">
        <h3 style=\"float: left; margin: 10px !important;\">";
        // line 37
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Gallery Name:")), "html", null, true);
        echo "</h3>
        <input name=\"title\" type=\"text\" style=\"float: left; width: 60%;\"/>
        <button id=\"gallery-create\" class=\"button button-primary\" type=\"button\">
            <i class=\"fa fa-check\"></i>
            ";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
        echo "
        </button>
        ";
        // line 46
        echo "
        <div class=\"clear\"></div>
        <input id=\"presetValue\" name=\"preset\" type=\"hidden\" value=\"1\"/>
    </div>
    ";
        // line 51
        echo "    <div id=\"gg-create-gallery-text\">
        <div class=\"presetSelect\">
            ";
        // line 53
        $context["preset"] = $this;
        // line 54
        echo "
            ";
        // line 55
        $context["presets"] = array(0 => array("title" => "Standard Gallery", "image" => "template1.jpg", "pro" => false, "value" => 1), 1 => array("title" => "Vertical Gallery", "image" => "template2.jpg", "pro" => false, "value" => 2), 2 => array("title" => "Rounded Gallery", "image" => "template3.jpg", "pro" => false, "value" => 3), 3 => array("title" => "Horizontal Gallery", "image" => "template4.jpg", "pro" => false, "value" => 4), 4 => array("title" => "Categories and Icons", "image" => "template5.jpg", "pro" => true, "value" => 5, "link" => "https://supsystic.com/categories-gallery-example/"), 5 => array("title" => "Post feed and Pagination", "image" => "template6.jpg", "pro" => true, "value" => 6, "link" => "https://supsystic.com/pagination-gallery-example/"), 6 => array("title" => "Post feed Slide Up", "image" => "template7.jpg", "pro" => true, "value" => 7, "link" => "https://supsystic.com/post-feed-slide-up/"), 7 => array("title" => "Post feed Description", "image" => "template8.jpg", "pro" => true, "value" => 8, "link" => "https://supsystic.com/post-feed-description/"), 8 => array("title" => "Mosaic Gallery", "image" => "template9.png", "pro" => true, "value" => 9, "link" => "https://supsystic.com/mosaic-gallery-example/"));
        // line 66
        echo "
            ";
        // line 68
        echo "            ";
        // line 71
        echo "
            ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["presets"]) ? $context["presets"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
            // line 73
            echo "                ";
            echo $context["preset"]->getputPreset($context["data"]);
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "        </div>
    </div>
    <div id=\"gg-create-gallery-loader\" style=\"display: none;\">
        <p class=\"gg-centered\">

        <div class=\"gg-inline-loader gg-centered\"></div>
        </p>
    </div>
";
    }

    // line 3
    public function getputPreset($__data__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 4
            echo "    <div class=\"preset ";
            if ((($this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "isPro", array(), "method") == false) && $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "pro", array()))) {
                echo "disabled";
            }
            echo "\"
         data-preset=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "value", array()), "html", null, true);
            echo "\">
        ";
            // line 6
            if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "pro", array()) && ($this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "isPro", array(), "method") == false))) {
                // line 7
                echo "            <img onclick=\"document.location='";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "link", array()), "html", null, true);
                echo "'\" src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "getModule", array(0 => "galleries"), "method"), "getLocationUrl", array(), "method"), "html", null, true);
                echo "/assets/img/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "image", array()), "html", null, true);
                echo "\" alt=\"\"/>
            <a class=\"button button-primary\" href=\"";
                // line 8
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "link", array()), "html", null, true);
                echo "\" style=\"position: absolute; top: 50%; left: 30%; background-color: #ffffff;\">
                Available in PRO
            </a>
        ";
            } else {
                // line 12
                echo "            <img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["environment"]) ? $context["environment"] : null), "getModule", array(0 => "galleries"), "method"), "getLocationUrl", array(), "method"), "html", null, true);
                echo "/assets/img/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "image", array()), "html", null, true);
                echo "\" alt=\"\"/>
            <div style=\"position: absolute; top: 50%; left: 50%; transform:translate(-50%, -50%); display:table;\">
                <a class=\"button button-primary button-select\" style=\"background-color: #ffffff;\">
                    Select
                </a>
                <span class=\"selected-preset\">";
                // line 17
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Selected")), "html", null, true);
                echo "</span>
            </div>
        ";
            }
            // line 20
            echo "        <div class=\"preset-overlay\">
            <h3>";
            // line 21
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "title", array())), "html", null, true);
            echo "</h3>
        </div>
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@galleries/gallery_preset.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 21,  180 => 20,  174 => 17,  163 => 12,  156 => 8,  147 => 7,  145 => 6,  141 => 5,  134 => 4,  122 => 3,  110 => 75,  101 => 73,  97 => 72,  94 => 71,  92 => 68,  89 => 66,  87 => 55,  84 => 54,  82 => 53,  78 => 51,  72 => 46,  67 => 41,  60 => 37,  54 => 35,  51 => 34,  42 => 30,  35 => 28,  32 => 27,  29 => 26,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@galleries/gallery_preset.twig", "/var/www/vhosts/kodexasia.com/httpdocs/polytek/wp-content/plugins/gallery-by-supsystic/src/GridGallery/Galleries/views/gallery_preset.twig");
    }
}
