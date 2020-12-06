{% extends '../../Common/Views/layout/main.volt' %}

{% block content %}

<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
  </div>
{% endblock %}


{% block moduleCss %}
<link href="/assets/css/homepage.css" rel="stylesheet">
{% endblock %}


{% block menunav %}
<li class="nav-item active">
    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
</li>
{% endblock %}