<aside class="flex flex-col h-full w-[15%] fixed">
    <div class="bg-layer">
        <div class="logoBoxSB flex justify-center">
            <img width="150" src="/assets/logo-white.png" alt="">
        </div>
        <div class="sbLinksBox">

            <ul>
                <a href="/admin/profile"><?php require('./assets/dashboard.svg') ?> <p>Dashboard</p></a>
                <a href="/admin/clients"><?php require('./assets/profile.svg') ?> <p>Clients</p></a>
                <a href="/admin/agents"><?php require('./assets/subscription.svg') ?> <p>Agents</p></a>
                <a href="/admin/cards"><?php require('./assets/card.svg') ?> <p>Cards</p></a>
            </ul>
        </div>
        <div class="w-full flex justify-center">
            <button class="text-white flex items-center gap-2"><?php require('./assets/log-out.svg') ?> Log Out</button>
        </div>

    </div>

</aside>