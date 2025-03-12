<?php

use PHPUnit\Framework\TestCase;
use Philipp15b\i18n;

class I18nTestCase extends TestCase
{

    public function testI18nEn() {
        $i18n = new I18n();
        $i18n->setCachePath(__DIR__);
        $i18n->setFilePath(__DIR__ . '/lang_{LANGUAGE}.yml');
        $i18n->setFallbackLang('en');
        $i18n->setForcedLang('en');
        $i18n->setPrefix("LangEn");
        $i18n->init(true);

        $this->assertEquals('Hello World!', LangEn::greeting);
        $this->assertEquals('This text should be merged to Spanish when english is a fallback', LangEn::category_missing);
        $this->assertEquals("this is a very deeply nested key", LangEn::deep_ly_nested_key);
        $this->assertEquals("this key is missing from es and should fallback", LangEn::deep_ly_nested_missing);

    }

    public function testI18nFallsBackToFallbackLang() {
        $i18n = new I18n();
        $i18n->setCachePath(__DIR__);
        $i18n->setFilePath(__DIR__ . '/lang_{LANGUAGE}.yml');
        $i18n->setFallbackLang('en');
        $i18n->setForcedLang('es');
        $i18n->setPrefix("LangEs");
        $i18n->init(true);

        // Matching keys like greeting should take what's in the forced lang file (es in this case)
        $this->assertEquals('Hola World!', LangEs::greeting);
        // Missing nested keys should fall back to the fallback lang file
        $this->assertEquals('This text should be merged to Spanish when english is a fallback', LangEs::category_missing);
        $this->assertEquals("this is a very, very deeply nested key", LangEs::deep_ly_nested_key);
        $this->assertEquals("this key is missing from es and should fallback", LangEs::deep_ly_nested_missing);
    }

}
