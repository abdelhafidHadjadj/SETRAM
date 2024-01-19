<aside class="flex flex-col h-full w-[15%] fixed">
    <div class="bg-layer">
        <div class="logoBoxSB flex justify-center">
            <img width="150" src="/assets/logo-white.png" alt="">
        </div>
        <div class="sbLinksBox">

            <ul>
                <a href="dashboard"><?php require('./assets/dashboard.svg') ?> <p>Dashboard</p></a>
                <a href="profile"><?php require('./assets/profile.svg') ?> <p>Edit Profile</p></a>
                <a href="subscription"><?php require('./assets/subscription.svg') ?> <p>Subscription</p></a>
                <a href="mycard"><?php require('./assets/card.svg') ?> <p>My Card</p></a>
            </ul>
        </div>
        <div class="w-full flex justify-center">
            <button class="text-white flex items-center gap-2"><?php require('./assets/log-out.svg') ?> Log Out</button>
        </div>

    </div>

</aside>