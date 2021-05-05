# SuluFormLandingPageBundle

Since the Sulu core team is not sure yet about the best way to implement landing pages for forms we've
created a simple workaround.

## Installation

Install using composer:

```
composer require innomedio/sulu-form-landing-page-bundle
```

Add the bundle to ``config/bundles.php`` if it's not automatically added:
```
Innomedio\Sulu\FormLandingPageBundle\InnomedioSuluFormLandingPageBundle::class => ['all' => true],  
```

## Usage

You can now define the redirect url once a form is submitted successfully. You can also define a
querystring that needs to be appended.

```twig
{{ form_start(content.testForm) }}
    <input type="hidden" name="_sulu_form_redirect" value="{{ sulu_content_load(content.landingPage).path }}" />
    <input type="hidden" name="_sulu_form_querystring" value="?utm=this&id=that" />
{{ form_end(content.formForTesting) }}
```

So you could for example create a content block containing a single_page_selection and single_form_selection field,

There's also a helper template available:

```twig
{% include '@InnomedioSuluFormLandingPage/sulu_redirect_form.html.twig' with {
    form: content.testForm,
    redirect: sulu_content_load(content.landingPage).path,
    querystring: '?utm=this&id=that'
} %}
```