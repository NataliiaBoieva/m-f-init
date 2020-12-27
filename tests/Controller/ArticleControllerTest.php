<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'What is this all about?');
    }
    public function testArticlePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(3, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('Gamine-Dramatic');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Gamine-Dramatic');
        $this->assertSelectorExists('div:contains("There are 8 comments")');
    }
}