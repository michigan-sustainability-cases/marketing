<?php snippet('head') ?>
<?php snippet('header') ?>

<main class="main" role="main">
<div class="t-site">

<nav class="c-events-nav">
<ul>
  <li><a href="<?php echo $pages->find('events')->url() ?>" class="<?php e($page->isOpen() && !$pages->find('events')->find('previous-events')->isOpen(), 'active') ?>">Upcoming</a></li>
  <li><a href="<?php echo $pages->find('events')->find('previous-events')->url() ?>" class="<?php e($pages->find('events')->find('previous-events')->isOpen(), 'active') ?>">Previous</a></li>
</ul>
</nav>

<div class="o-search-box">
  <div>
    <span><img srcset="https://msc-public.imgix.net/magnifier.png?w=24&amp; 1x,https://msc-public.imgix.net/magnifier.png?w=48&amp; 2x,https://msc-public.imgix.net/magnifier.png?w=72&amp; 3x," src="https://msc-public.imgix.net/magnifier.png?w=24&amp;" alt="icon for search"></span>
    <input type="text" class="o-search-box__text" placeholder="Search input" name="q"
      oninput="SortEvents.setQueryString(event.currentTarget.value)" onfocus="$('.o-search-box').addClass('o-search-box--active')" onblur="$('.o-search-box').removeClass('o-search-box--active')"
    >
    </div>
    <div class="c-active-filters-container">
      <div class="o-search-box__active-filters"></div>
      <a class="o-search-box__button" style="display: none" onclick="SortEvents.clearFilters()">clear all ×</a>
    </div>
</div>

<div class="c-search-filters">
  <h3>Filter events by:</h3>
  <div class="c-search-filters__category">
  <h4>Host:</h4>
  <ul>
    <li><label for="msc"><input type="checkbox" id="msc" name="host" onclick="SortEvents.toggleHost('MSC')"> MSC</label></li>
    <li><label for="other"><input type="checkbox" id="other" name="host" onclick="SortEvents.toggleHost('Others')"> Other institutions</label></li>
  </ul>
  </div>

  <div class="c-search-filters__category">
  <h4>Type:</h4>
  <ul>
    <li><label for="workshop"><input type="checkbox" id="workshop" name="type" onclick="SortEvents.toggleType('Workshop/Seminar')"> Workshop/Seminar</label></li>
    <li><label for="lecture"><input type="checkbox" id="lecture" name="type" onclick="SortEvents.toggleType('Lecture')"> Lecture</label></li>
    <li><label for="webinar"><input type="checkbox" id="webinar" name="type" onclick="SortEvents.toggleType('Webinar')"> Webinar</label></li>
    <li><label for="meeting"><input type="checkbox" id="meeting" name="type" onclick="SortEvents.toggleType('Meeting/Conference')"> Meeting/Conference</label></li>
    <li><label for="othertypes"><input type="checkbox" id="othertypes" name="type" onclick="SortEvents.toggleType('Other')"> Other</label></li>
  </ul>
  </div>

  <div class="c-search-filters__category">
  <h4>Topics:</h4>
  <ul>
    <li><label for="production"><input type="checkbox" id="production" name="topic" onclick="SortEvents.toggleTopic('Case production')"> Case production</label></li>
    <li><label for="methodology"><input type="checkbox" id="methodology" name="topic" onclick="SortEvents.toggleTopic('Case methodology')"> Case methodology</label></li>
    <li><label for="assessment"><input type="checkbox" id="assessment" name="topic" onclick="SortEvents.toggleTopic('Assessment and evaluation')"> Assessment and evaluation</label></li>
    <li><label for="teaching"><input type="checkbox" id="teaching" name="topic" onclick="SortEvents.toggleTopic('Case teaching')"> Case teaching</label></li>
  </ul>
  </div>
</div>

<!-- // <?php $eventi = $page->eventitems()->toStructure() ?>
// <?php if($eventi->date("Y-m-d") < date("Y-m-d")):?>
// <p style="margin-top: 2.5em; margin-bottom: 4em;">There is no upcoming events at this point. You can checkout <a href="events/previous-events">information and materials from previous events</a>.</p>
// <?php endif ?> -->

<?php foreach($page->eventitems()->toStructure()->sortBy($sort='date', $direction='asc') as $eventitem): ?>
<?php if($eventitem->date("Y-m-d") >= date("Y-m-d")):?>
  <div class="c-single-event o-flex-container"
    data-event-type="<?php echo $eventitem->type() ?>"
    data-event-host="<?php echo $eventitem->host() ?>"
    data-event-topics="<?php echo $eventitem->topics() ?>"
    data-event-name="<?php echo $eventitem->name() ?>"
  >
    <div class="c-event-description o-flex-item-growing">
      <div class="c-event-description__topics">
        <p>Topics:</p>
        <ul class="c-event-tags">
          <?php foreach($eventitem->topics()->split() as $eventtopic): ?>
          <li><?php echo $eventtopic ?></li>
          <?php endforeach ?>
        </ul>
      </div>
      <h2><?php echo $eventitem->name() ?></h2>
      <p><?php echo $eventitem->date('l F j, Y') ?> — <?php echo $eventitem->type() ?></p>
      <p>Hosted by: <?php echo $eventitem->host() ?></p>
    </div>
    <div class="c-event-registration o-flex-item-growing">
      <div>
        <p><span><img srcset="https://msc-public.imgix.net/icon-time.png?w=24&amp; 1x,https://msc-public.imgix.net/icon-time.png?w=48&amp; 2x,https://msc-public.imgix.net/icon-time.png?w=72&amp; 3x," src="https://msc-public.imgix.net/icon-time.png?w=24&amp;" alt="icon for time"></span><?php echo $eventitem->time() ?></p>
        <p><span><img srcset="https://msc-public.imgix.net/icon-location.png?w=24&amp; 1x,https://msc-public.imgix.net/icon-location.png?w=48&amp; 2x,https://msc-public.imgix.net/icon-location.png?w=72&amp; 3x," src="https://msc-public.imgix.net/icon-location.png?w=24&amp;" alt="icon for location"></span>
          <a href="<?php echo $eventitem->locationlink() ?>" target="_blank"><?php echo $eventitem->location() ?></a>
        </p>
        <p>Open to: <?php echo $eventitem->limitation() ?></p>
        <a class="c-button" href="<?php echo $eventitem->eventlink() ?>" target="_blank">Learn more/register</a>
      </div>
    </div>
  </div>
<?php endif ?>
<?php endforeach ?>


</div><!--t-site-->


</body>
</html>




</main>

<?php snippet('footer') ?>
