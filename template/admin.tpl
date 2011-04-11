<div class="titrePage">
  <h2>{'Installed Themes'|@translate}</h2>
</div>

<div id="themesContent">
<fieldset>
<legend>{'iconset_All_Themes'|@translate}</legend>
<form action="" method="post" name="externe">
<div class="themeBoxes">
{foreach from=$all_themes item=theme}
  <div class="themeBox">
    <div class="themeName">{$theme.name}</div>
    <div class="themeShot"><img src="{$theme.screenshot}" alt="screenshot"></div>
    <div class="themeActions">
      <div>
      <select name="set">
        <option value="NULL">{'iconset_nochange'|@translate}</option>
        <option value="NULL">{'iconset_nothing'|@translate}</option>
        {foreach from=$list_set item=ls}
        <option value="{$ls.FILE}">{$ls.TEXTE}</option>
        {/foreach}
      </select>
      </div>
    </div> <!-- themeActions -->
  </div>
{/foreach}
</div> <!-- themeBoxes -->
  <input name="envoi_config" type="hidden" value="iconset" />
  <input type="hidden" name="pwg_token" value="{$PWG_TOKEN}">
  <input type="submit" name="button2" id="button2" value="{'iconset_send'|@translate}" />
</form>
</fieldset>

<fieldset>
<legend>{'iconset_All_Icons'|@translate}</legend>
<div class="iconBoxes">
{foreach from=$all_icons item=icons}
  <div class="iconBox">
    <div class="iconName">{$icons.name}</div>
    <div class="iconShot"><img src="{$icons.png}" alt=""></div>
  </div>
{/foreach}
</div> <!-- themeBoxes -->
</fieldset>
</div> <!-- themesContent -->
