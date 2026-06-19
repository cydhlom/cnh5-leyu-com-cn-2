<?php

class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private string $domain;
    private string $keyword;
    private string $color;
    private string $icon;

    public function __construct(
        string $title = '',
        string $description = '',
        string $url = 'https://cnh5-leyu.com.cn',
        string $domain = 'cnh5-leyu.com.cn',
        string $keyword = '乐鱼体育',
        string $color = '#1a73e8',
        string $icon = '🔗'
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->domain = $domain;
        $this->keyword = $keyword;
        $this->color = $color;
        $this->icon = $icon;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function render(): string
    {
        $title = htmlspecialchars($this->title ?: $this->keyword . ' 官方平台', ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($this->description ?: '欢迎访问 ' . $this->keyword . '，提供优质在线服务。', ENT_QUOTES, 'UTF-8');
        $url = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $domain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');
        $keyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($this->color, ENT_QUOTES, 'UTF-8');
        $icon = htmlspecialchars($this->icon, ENT_QUOTES, 'UTF-8');

        return <<<HTML
<div class="link-card" style="border:1px solid #e0e0e0;border-radius:8px;padding:16px;max-width:400px;font-family:sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
    <div style="display:flex;align-items:flex-start;gap:12px;">
        <div style="font-size:24px;line-height:1;">{$icon}</div>
        <div style="flex:1;min-width:0;">
            <div style="font-size:16px;font-weight:600;color:#222;margin-bottom:4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{$title}</div>
            <div style="font-size:13px;color:#555;line-height:1.4;margin-bottom:8px;">{$description}</div>
            <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                <span style="font-size:12px;color:{$color};background:{$color}10;padding:2px 8px;border-radius:4px;font-weight:500;">{$keyword}</span>
                <a href="{$url}" target="_blank" rel="noopener noreferrer" style="font-size:12px;color:{$color};text-decoration:none;border-bottom:1px dotted {$color}40;">{$domain}</a>
            </div>
        </div>
    </div>
</div>
HTML;
    }

    public static function fromArray(array $data): self
    {
        $card = new self();
        if (isset($data['title'])) {
            $card->setTitle($data['title']);
        }
        if (isset($data['description'])) {
            $card->setDescription($data['description']);
        }
        if (isset($data['url'])) {
            $card->setUrl($data['url']);
        }
        if (isset($data['domain'])) {
            $card->setDomain($data['domain']);
        }
        if (isset($data['keyword'])) {
            $card->setKeyword($data['keyword']);
        }
        if (isset($data['color'])) {
            $card->setColor($data['color']);
        }
        if (isset($data['icon'])) {
            $card->setIcon($data['icon']);
        }
        return $card;
    }

    public static function renderDefault(): string
    {
        $card = new self();
        return $card->render();
    }

    public static function renderWithCustom(string $title, string $description, string $url, string $keyword): string
    {
        $card = new self();
        $card->setTitle($title);
        $card->setDescription($description);
        $card->setUrl($url);
        $card->setKeyword($keyword);
        return $card->render();
    }
}

function render_link_card(
    string $title = '',
    string $description = '',
    string $url = 'https://cnh5-leyu.com.cn',
    string $keyword = '乐鱼体育'
): string {
    $card = LinkCard::fromArray([
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'keyword' => $keyword,
    ]);
    return $card->render();
}