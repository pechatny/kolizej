<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'key' => 'contacts',
            'description' => 'Контакты',
            'keywords' => '1',
            'title' => '1',
            'page_title' => 'Контакты',
            'text' => '<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<div class="contact Map island">
				<div id="map"></div>
				<div class="item location">
					<b>ул. Заводская 21а</b>, Зеленоград, г. Москва, 124527
				</div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="contact Info island">
				<h2>
					ООО “Колизей”
					<span>Мебельное производство корпусной мебели</span>
				</h2>
				<div class="item phone">
					Городской телефон<br>
					<a href="tel:+74959797858">+7 (495) 979-78-58</a>
				</div>
				<div class="item mobile">
					Мобильный телефон<br>
					<a href="tel:+79161234455">+7 (916) 123-44-55</a>
				</div>
				<div class="item time">
					Время работы<br>
					<b>Каждый день с 9:00 до 22:00</b>
					<div class="help">Заказы через корзину интернет-магазина принимаются круглосуточно и обрабатываются в рабочие часы магазина.</div>
				</div>
				<div class="item mail">
					Электронная почта<br>
					<a href="mailto:mail@kolizej.ru">mail@kolizej.ru</a>
				</div>
				<div class="item partner">
					Будем рады сотрудничеству с Вами!
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="bigheight clear"></div>',
        ]);

        Page::create([
            'key' => 'orderFurniture',
            'description' => 'Мебель на заказ',
            'keywords' => '1',
            'title' => '1',
            'page_title' => 'Мебель на заказ',
            'text' => '<div class="container">
	<div class="island">
		<p>Наши специалисты изготовят для Вас корпусную мебель (шкафы, кухни, столы, стенки) на заказ по индивидуальным чертежам.</p>

		<p>Звоните в офис по номеру <a href="tel:+74959797858">+7 (495) 979-78-58</a></p>
	</div>
</div>',
        ]);
        Page::create([
            'key' => 'wholesalers',
            'description' => 'Оптовикам',
            'keywords' => '1',
            'title' => '1',
            'page_title' => 'Оптовикам',
            'text' => '<div class="container">
	<div class="island">
		<p>У нашей компании 15-летний опыт работы с оптовиками и магазинами. Поскольку, мы, являемся производителями мебели, то можем предложить нашим партнерам самые выгодные условия. У нас действует система скидок от объема покупки, гибкие условия оплаты, гарантия на все товары, информационная поддержка и рекламные материалы. </p>

		<p>Если Вас заинтересовало наше предложение звоните в офис по телефону <a href="tel:+74959797858">+7 (495) 979-78-58</a> или пишите на электронную почту <a href="mailto:mail@kolizej.ru">mail@kolizej.ru</a></p>
	</div>
</div>',
        ]);
        Page::create([
            'key' => 'delivery',
            'description' => 'Доставка',
            'keywords' => '1',
            'title' => '1',
            'page_title' => 'Доставка',
            'text' => '<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<div class="delivery island">
				<h2>Доставка</h2>

				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>

				<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>

				<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>

				<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>

				<p>Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>

				<p>Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="payment island">
				<h2>Оплата</h2>

				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>

				<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>

				<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>

				<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>

				<p>Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>

				<p>Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>',
        ]);

    }
}
