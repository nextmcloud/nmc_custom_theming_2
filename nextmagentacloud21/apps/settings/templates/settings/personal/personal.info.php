<?php

/**
 * @copyright Copyright (c) 2017 Arthur Schiwon <blizzz@arthur-schiwon.de>
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Thomas Citharel <tcit@tcit.fr>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/** @var \OCP\IL10N $l */
/** @var array $_ */

script('settings', [
  'usersettings',
  'templates',
  'federationsettingsview',
  'federationscopemenu',
  'settings/personalInfo',
 'vue-settings-personal-info',
]);
?>

<div id="personal-settings" data-lookup-server-upload-enabled="<?php p($_['lookupServerUploadEnabled'] ? 'true' : 'false') ?>">
  <h2 class="hidden-visually"><?php p($l->t('Personal info')); ?></h2>
  <div id="personal-settings-avatar-container" class="personal-settings-container">
   <h3><?php p($l->t('Account details')); ?></h3>

  <div class="personal-settings-container">
    <div class="personal-settings-setting-box">
      <form id="displaynameform" class="section">
        <h3>
          <label for="displayname"><?php p($l->t('Name')); ?></label>
          <a href="#" class="federation-menu" aria-label="<?php p($l->t('Change privacy level of full name')); ?>">
            <span class="icon-federation-menu icon-password">
              <span class="icon-triangle-s"></span>
            </span>
          </a>
        </h3>
        <input type="text" id="displayname" name="displayname" read-only  value="<?php p($_['displayName']) ?>" autocomplete="on" autocapitalize="none" autocorrect="off" readonly/>
        <span class="icon-checkmark hidden"></span>
        <span class="icon-error hidden"></span>
        <input type="hidden" id="displaynamescope" value="<?php p($_['displayNameScope']) ?>">
      </form>
    </div>


    <div class="personal-settings-setting-box">
    <?php if (isset($_['activelanguage'])) { ?>
        <form id="language" class="section">
          <h3>
            <label for="languageinput"><?php p($l->t('Language')); ?></label>
          </h3>
          <select id="languageinput" name="lang" data-placeholder="<?php p($l->t('Language')); ?>">
            <option style="" value="<?php p($_['activelanguage']['code']); ?>">
              <?php p(strstr($_['activelanguage']['name'], '(', true)); ?>
            </option>
            <optgroup label="––––––––––"></optgroup>
            <?php foreach ($_['commonlanguages'] as $language) : ?>
              <?php if ($language['code'] == "de_DE") { ?>
                 <option value="<?php p($language['code']); ?>">
                  <?php p(strstr($language['name'], '(', true)); ?>
                </option>
              <?php } ?>
            <?php endforeach; ?>

            <?php foreach (array_unique($_['languages'], SORT_REGULAR) as $language) : ?>
              <?php if ($language['code'] == "en_GB") { ?>
                <option value="<?php p($language['code']); ?>">
                   <?php p(strstr($language['name'], '(', true)); ?>
                </option>
              <?php } ?>
            <?php endforeach; ?>


          </select>
          <a href="https://www.transifex.com/nextcloud/nextcloud/" target="_blank" rel="noreferrer noopener">
            <em><?php p($l->t('Help translate')); ?></em>
          </a>
        </form>
      <?php } ?>
    </div>
  </div>
  <div class="profile-settings-container">
    <div id="vue-emailsection" class="section"></div>
    <!-- <span class="msg"></span> -->
  </div>
  <div class="telekom-link">
  <p><label><?php p($l->t('You can add an alternative email address to receive your notifications there. It will also be used as an address for shared content. Your password can be changed in the')); ?>
    <a href='https://account.idm.telekom.com/account-manager/index.xhtml' target='_blank'> <?php p($l->t('login settings')); ?></a>
          <?php p($l->t('for all Telekom services.')); ?>
    </label>
    </p>

    <div class="personal-settings-setting-box personal-settings-group-box section">
     <b><?php p($l->t('Storage utilisation')); ?></b>
      <div id="quota" class="personal-info icon-quota">
        <div class="quotatext-bg">
          <h4 class="quotatext">
            <?php if ($_['quota'] === \OCP\Files\FileInfo::SPACE_UNLIMITED) : ?>
              <strong><?php p($_['usage']); ?></strong> <?php p($l->t('of')); ?> <?php p($_['total_space']); ?>
            <?php else : ?>
              <strong><?php p($_['usage']); ?></strong> <?php p($l->t('of')); ?> <?php p($_['total_space']); ?>
            <?php endif ?>
            </h4>
            <span class="space-occupied">
            <?php p($l->t('Memory')); ?> <?php p($_['usage_relative']); ?>% <?php p($l->t('occupied')); ?>
            </span>
        </div>
        <!-- <progress value="<?php p($_['usage_relative']); ?>" max="100" <?php if ($_['usage'] > 80) : ?> class="warn" <?php endif; ?>></progress> -->
          <div class="settings-progress-bar">
            <div class="progress-bar styledbar files-usage" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php isset($_['filesSizeInPer'])?p($_['filesSizeInPer']):""; ?>%;">
            </div>
            <div class="progress-bar styledbar photos-usage" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php isset($_['photoVideoSizeInPer'])?p($_['photoVideoSizeInPer']):""; ?>%;">
            </div>

            <div class="progress-bar styledbar bin-usage" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php isset($_['trashSizeInPer'])?p($_['trashSizeInPer']):""; ?>%;">
            </div>
          </div>
        </div>
      <div class="extra-details">
      <div>
        <div id="files" class="files-usage"></div>
        <?php p($l->t('Files')); ?>:<strong><?php isset($_['filesSize'])?p($_['filesSize']):""; ?></strong>
      </div>
        <div>
          <div id="photos" class="photos-usage"></div>
            <?php p($l->t('Photos & videos')); ?>:<strong><?php isset($_['photoVideoSize'])?p($_['photoVideoSize']):""; ?></strong>
        </div>
        <div>
        <div>
          <div id="bin" class="bin-usage"></div>
          <?php p($l->t('Recycle Bin')); ?>:<strong><?php isset($_['trashSize'])?p($_['trashSize']):""; ?></strong>
        </div>
    </div>
  <div class="recycle-para">
     <?php print_unescaped($l->t(
                'The recycle bin is automatically tidied up.'
              )); ?>
  </div>
<div class="para-2">
<?php print_unescaped($l->t(
                'Files that have been in the recycle bin for longer than 30 days are automatically deleted permanently and free up storage space.'
              )); ?>
</div>


  </div>


  <?php
    $totalSpaceInGB = null;
    if($_['quota']>=1024){ // bytes converted
      $totalSpaceInKB = round($_['quota'] / 1024, 1);
      $totalSpaceInMB = round($totalSpaceInKB / 1024, 1);
      $totalSpaceInGB = round($totalSpaceInMB / 1024, 1);
    }

?>
<div id="tarrifInfo" class="personal-settings-tarrif personal-settings-tarrif-box">
  <h4><?php p($l->t('Tariff information')); ?></h4>
    <div>
        <strong><?php p($l->t('Your tariff')); ?></strong>:
        <?php
            if ($_['quota'] == 0) {
                p($l->t('No space allocated'));
            }elseif($_['quota'] === \OCP\Files\FileInfo::SPACE_UNLIMITED){
                p($l->t('Unlimited'));
            }elseif($_['quota'] === \OCP\Files\FileInfo::SPACE_UNKNOWN){
                p($l->t('Space unknown'));
            }elseif($_['quota'] === \OCP\Files\FileInfo::SPACE_NOT_COMPUTED){
                p($l->t('Space not computed'));
            }elseif ($totalSpaceInGB  == 3 || $totalSpaceInGB == 10){
                p($l->t('MagentaCLOUD Free'));
            }elseif ($totalSpaceInGB  == 15 || $totalSpaceInGB == 25){
                p($l->t('MagentaCLOUD S'));
            }elseif ($totalSpaceInGB == 100){
                p($l->t('MagentaCLOUD M'));
            }else if ($totalSpaceInGB == 500){
                p($l->t('MagentaCLOUD L'));
            }else if ($totalSpaceInGB == 1024){
                p($l->t('MagentaCLOUD XL'));
            }else if ($totalSpaceInGB == 5120){
                p($l->t('MagentaCLOUD XXL'));
            }
        ?>
    </div>
    <div>
    <strong><?php p($l->t('Storage')); ?></strong>: <?php p($_['total_space']); ?>
    </div>
    <div>
        <a href="https://cloud.telekom-dienste.de/tarife" target="_blank">
        <button>
        <?php print_unescaped($l->t('Expand storage')); ?>
        </button>
        </a>
    </div>
<div>


  <div id="personal-settings-group-container">

  </div>

</div>
</div>
