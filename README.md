SimpleGravatar
==============

A super simple class to generate Gravatar images based on email addresses.

Usage Example
==============

Return a gravatar with the .jpg extension, sized 64 x 64 with Mystery Man as the default should there be no set gravatar with a secure URL in use. The actual finished <img> tag is to be returned and the email "euantor [at] mybb.com" is to be used.

    <?php
    require 'SimpleGravatar.class.php';
    $gravatar = new SimpleGravatar;

    echo $gravatar->setExtension('jpg')
             ->setSize(64)
             ->setDefault('mm')
             ->setSecure()
             ->getGravatar(true, 'euantor@mybb.com');

    echo $gravatar->GetGravatar(true, 'anotheremail@domain.com'); // We already set our settings above so if we just want to get another gravatar we don't need to repeat it all.