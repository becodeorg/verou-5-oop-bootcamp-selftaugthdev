<?php

declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Content {
    protected string $title;
    protected string $text;

    public function __construct(string $title, string $text) {
        $this->title = $title;
        $this->text = $text;
    }

    public function getOriginalTitle(): string {
        return $this->title;
    }

    public function displayTitle(): string {
        return $this->title;
    }

    public function display(): string {
        return "<h2>" . $this->displayTitle() . "</h2><p>" . $this->text . "</p>";
    }
}

class Article extends Content {
    private bool $isBreaking;

    public function __construct(string $title, string $text, bool $isBreaking = false) {
        parent::__construct($title, $text);
        $this->isBreaking = $isBreaking;
    }

    public function displayTitle(): string {
        $title = $this->isBreaking ? "BREAKING: " . $this->title : $this->title;
        return $title;
    }
}

class Ad extends Content {
    public function displayTitle(): string {
        return strtoupper($this->title);
    }
}

class Vacancy extends Content {
    public function displayTitle(): string {
        return $this->title . " - apply now!";
    }
}

$contents = [
    new Article("Today's Weather", "FREEZING cold."),
    new Article("Local Sports", "The Ghent team wins again!", true), // Breaking news
    new Ad("Sale", "Big discounts on electronics!"),
    new Vacancy("Software Developer", "Join our awesome software development team.")
];

foreach ($contents as $content) {
    echo $content->display() . "<br>";
}

