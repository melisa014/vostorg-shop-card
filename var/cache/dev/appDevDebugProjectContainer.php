<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerRqpeszw\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerRqpeszw/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerRqpeszw.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerRqpeszw\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerRqpeszw\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Rqpeszw',
    'container.build_id' => 'b7affbce',
    'container.build_time' => 1516094634,
));