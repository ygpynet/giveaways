<?php

namespace ErnestDefoe\Giveaways\Formatter;

use s9e\TextFormatter\Configurator;

class GiveawayCardConfigure
{
    public function __invoke(Configurator $config): void
    {
        $config->BBCodes->addCustom(
            '[giveaway slug={TEXT} cover={URL?}]',
            <<<'XML'
<a class="GiveawayCard" href="/giveaways/{@slug}" style="margin:20px">
  <xsl:choose>
    <xsl:when test="@cover != ''">
        <div class="GiveawayCard-cover" style="background-image: url('{@cover}');">
          <span class="GiveawayCard-status GiveawayCard-status--{@status}">{@statuslabel}</span>
        </div>
      </xsl:when>
    <xsl:otherwise>
    <div class="GiveawayCard-cover GiveawayCard-cover--placeholder">
      <i class="icon fas fa-gift" aria-hidden="true"></i>
      <span class="GiveawayCard-status GiveawayCard-status--{@status}">{@statuslabel}</span>
    </div>
     </xsl:otherwise>
  </xsl:choose>
  <div class="GiveawayCard-body">
    <h3 class="GiveawayCard-title">{@title}</h3>
    <div class="GiveawayCard-prize"><i class="icon fas fa-trophy" aria-hidden="true"></i> {@prize}</div>
    <div class="GiveawayCard-meta">
      <span><i class="icon fas fa-clock" aria-hidden="true"></i> {@endsin}</span>
      <span><i class="icon fas fa-users" aria-hidden="true"></i> {@entrants} 人参与</span>
    </div>
  </div>
</a>
XML
        );

        $config->tags['GIVEAWAY']->attributes['slug']->required = true;
        $config->tags['GIVEAWAY']->rules->breakParagraph();
    }
}