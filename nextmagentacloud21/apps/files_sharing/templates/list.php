<?php
/** @var \OCP\IL10N $l */ ?>

<div class='controls-section'></div>
<div id='notification'></div>

<div id="emptycontent" class="hidden"></div>

<input type="hidden" name="dir" value="" id="dir">

<div class="nofilterresults hidden">
  <div class="icon-search"></div>
  <h2><?php p($l->t('No entries found in this folder')); ?></h2>
</div>

<table id="filestable" class="list-container <?php p($_['showgridview'] ? 'view-grid' : '') ?>">
 <thead>
  <tr>
   <th id='headerName' class="hidden column-name">
   <div id="headerName-container">
<a class="name sort columntitle" data-sort="name"><span><?php p($l->t('Name')); ?></span><span class="sort-indicator"></span></a>
</div>
    </th>
<th id="headerSize" class="hidden column-size">
  <a class="size sort columntitle" data-sort="size">
    <span><?php p($l->t('Size')); ?></span>
    <span class="sort-indicator zero-font"></span>
  </a>
</th>

<th id="headerDate" class="hidden column-mtime">
				<a id="modified" class="columntitle" data-sort="mtime"><span><?php p($l->t('Share time')); ?></span><span class="sort-indicator"></span></a>
			</th>

<th class="hidden column-expiration">
<a class="columntitle"><span><?php p($l->t('Expiration date')); ?></span></a>
</th>
  </tr>
 </thead>
 <tbody id="fileList">
 </tbody>
 <tfoot>
 </tfoot>
</table>
