<div class="island island--padded island--bottomed js-emoji-included">
    <h3 class="island__title">
        <a href="/<?= HTML::chars($events_uri) ?>">
            <?= $title ?>
        </a>
    </h3>
    <div class="events-block">
        <? foreach ($events as $event): ?>
            <div class="events-block__item">
                <?= View::factory('templates/components/event_card', [
                    'event' => $event,
                    'hide_event_author' => $hide_event_author
                ]); ?>
            </div>
        <? endforeach; ?>
    </div>
    <a href="/<?= HTML::chars($events_uri) ?>" class="island__link">
       <?= HTML::chars($link_text) ?> »
    </a>
</div>