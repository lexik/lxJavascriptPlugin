<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/../../lib/lxJavascriptStorage.class.php';

$t = new lime_test(8);

$t->is(lxJavascriptStorage::getRemoteJavascripts(), array(), '::getRemoteJavascripts() with empty array');
lxJavascriptStorage::addRemoteJavascript('url1');
$t->is(lxJavascriptStorage::getRemoteJavascripts(), array('url1'), '::getRemoteJavascripts() after queueing one remote script');
lxJavascriptStorage::addRemoteJavascript('url2');
$t->is(lxJavascriptStorage::getRemoteJavascripts(), array('url1', 'url2'), '::getRemoteJavascripts() after using ::addRemoteJavascript()');
lxJavascriptStorage::addRemoteJavascriptFirst('url3');
$t->is(lxJavascriptStorage::getRemoteJavascripts(), array('url3', 'url1', 'url2'), '::getRemoteJavascripts() after using ::addRemoteJavascriptFirst()');

$t->is(lxJavascriptStorage::getJavascriptCodeBlocks(), array(), '::getJavascriptCodeBlocks() with empty array');
lxJavascriptStorage::addJavascriptCode('codeblock1');
$t->is(lxJavascriptStorage::getJavascriptCodeBlocks(), array('codeblock1'), '::getJavascriptCodeBlocks() after queueing one code block');
lxJavascriptStorage::addJavascriptCode('codeblock2');
$t->is(lxJavascriptStorage::getJavascriptCodeBlocks(), array('codeblock1', 'codeblock2'), '::getJavascriptCodeBlocks() after using ::addJavascriptCode()');
lxJavascriptStorage::addJavascriptCodeFirst('codeblock3');
$t->is(lxJavascriptStorage::getJavascriptCodeBlocks(), array('codeblock3', 'codeblock1', 'codeblock2'), '::getJavascriptCodeBlocks() after using ::addJavascriptCodeFirst()');
