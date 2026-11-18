<?php

namespace App\Service;

class TextCatalog
{
    public function __construct(private readonly SiteLanguage $siteLanguage)
    {
    }

    public function translate(string $key): string
    {
        $translations = [
            'ru' => [
                'site.name' => 'Точка опоры',
                'site.description' => 'Небольшой сайт о бережной заботе о себе.',
                'site.lang' => 'ru',
                'nav.home' => 'Главная',
                'nav.about' => 'О проекте',
                'nav.contacts' => 'Контакты',
                'nav.aria' => 'Основная навигация',
                'footer.note' => 'Учебный проект на Symfony · Домашнее задание 8',
                'home.label' => 'Пространство поддержки',
                'home.title' => 'Забота о себе начинается с внимания',
                'home.lead' => 'Иногда полезно остановиться, прислушаться к себе и узнать, где искать поддержку. Этот сайт собрал простые материалы о психологическом благополучии.',
                'home.button' => 'О проекте',
                'home.section' => 'Что вы найдёте на сайте',
                'home.card1.title' => 'Понятная информация',
                'home.card1.text' => 'Коротко рассказываем о том, почему эмоции важны и как можно поддержать себя в непростой день.',
                'home.card2.title' => 'Бережный подход',
                'home.card2.text' => 'Здесь нет оценок и универсальных рецептов. У каждого человека свой опыт и свой темп.',
                'home.card3.title' => 'Куда обратиться',
                'home.card3.text' => 'На странице контактов собраны варианты, с которых можно начать поиск профессиональной помощи.',
                'home.closing' => 'Просмотрите разделы сайта и выберите то, что сейчас кажется вам полезным.',
                'about.label' => 'О проекте',
                'about.title' => 'Небольшой сайт с важной темой',
                'about.lead' => '«Точка опоры» — учебный проект о психологическом благополучии. Его задача — дать понятную информацию и напомнить, что просить о помощи нормально.',
                'about.section' => 'Наши принципы',
                'about.item1.title' => 'Уважение',
                'about.item1.text' => 'Не сравнивать переживания людей и не обесценивать их опыт.',
                'about.item2.title' => 'Доступность',
                'about.item2.text' => 'Писать простыми словами, чтобы информация была понятна каждому.',
                'about.item3.title' => 'Ответственность',
                'about.item3.text' => 'Сайт носит информационный характер и не заменяет консультацию специалиста.',
                'about.end' => 'Материалы предназначены для знакомства с темой. Если вам нужна помощь, обратитесь к квалифицированному специалисту.',
                'contacts.label' => 'Контакты и помощь',
                'contacts.title' => 'Не обязательно справляться в одиночку',
                'contacts.lead' => 'Если переживания мешают повседневной жизни, можно поговорить с психологом или психотерапевтом. Специалист поможет разобраться в ситуации и обсудить возможные шаги.',
                'contacts.section' => 'С чего начать',
                'contacts.item1.title' => 'Обратитесь к специалисту',
                'contacts.item1.text' => 'Ищите психолога с профильным образованием и опытом работы с вашим вопросом. Перед первой встречей можно уточнить образование, подход и стоимость.',
                'contacts.item2.title' => 'Поговорите с близким человеком',
                'contacts.item2.text' => 'Если сейчас трудно искать специалиста, расскажите человеку, которому доверяете, что вам нужна поддержка.',
                'contacts.item3.title' => 'Если есть непосредственная опасность',
                'contacts.item3.text' => 'При угрозе вашей жизни или безопасности другого человека позвоните в местную службу экстренной помощи.',
                'contacts.email.label' => 'Учебный адрес проекта:',
                'contacts.email' => 'hello@example.test',
                'contacts.notice' => 'Это учебный сайт: адрес указан как пример и не принимает обращения.',
            ],
            'en' => [
                'site.name' => 'A Steady Place',
                'site.description' => 'A small website about caring for your wellbeing.',
                'site.lang' => 'en',
                'nav.home' => 'Home',
                'nav.about' => 'About',
                'nav.contacts' => 'Contacts',
                'nav.aria' => 'Main navigation',
                'footer.note' => 'Symfony learning project · Homework 8',
                'home.label' => 'A place for support',
                'home.title' => 'Caring for yourself starts with paying attention',
                'home.lead' => 'Sometimes it helps to pause, listen to yourself, and learn where to find support. This website brings together simple information about psychological wellbeing.',
                'home.button' => 'About the project',
                'home.section' => 'What you will find here',
                'home.card1.title' => 'Clear information',
                'home.card1.text' => 'We briefly explain why emotions matter and how you can support yourself on a difficult day.',
                'home.card2.title' => 'A considerate approach',
                'home.card2.text' => 'There are no judgments or one-size-fits-all answers here. Everyone has their own experience and pace.',
                'home.card3.title' => 'Where to turn',
                'home.card3.text' => 'The contacts page lists a few ways to begin looking for professional support.',
                'home.closing' => 'Browse the pages and choose what feels useful to you right now.',
                'about.label' => 'About the project',
                'about.title' => 'A small website about an important topic',
                'about.lead' => '“A Steady Place” is a learning project about psychological wellbeing. Its goal is to share clear information and remind people that asking for help is okay.',
                'about.section' => 'Our principles',
                'about.item1.title' => 'Respect',
                'about.item1.text' => 'Do not compare people’s struggles or dismiss their experiences.',
                'about.item2.title' => 'Accessibility',
                'about.item2.text' => 'Use simple language so the information is easy to understand.',
                'about.item3.title' => 'Responsibility',
                'about.item3.text' => 'This website is informational and does not replace a consultation with a professional.',
                'about.end' => 'These materials are an introduction to the topic. If you need help, contact a qualified professional.',
                'contacts.label' => 'Contacts and support',
                'contacts.title' => 'You do not have to manage everything alone',
                'contacts.lead' => 'If your feelings are getting in the way of daily life, you can speak with a psychologist or therapist. A professional can help you understand the situation and discuss possible next steps.',
                'contacts.section' => 'Where to begin',
                'contacts.item1.title' => 'Contact a professional',
                'contacts.item1.text' => 'Look for a psychologist with relevant education and experience with your concern. Before a first session, you can ask about their training, approach, and fees.',
                'contacts.item2.title' => 'Talk to someone you trust',
                'contacts.item2.text' => 'If finding a professional feels difficult right now, tell someone you trust that you need support.',
                'contacts.item3.title' => 'If there is immediate danger',
                'contacts.item3.text' => 'If your life or someone else’s safety is at immediate risk, call your local emergency service.',
                'contacts.email.label' => 'Project contact for this demo:',
                'contacts.email' => 'hello@example.test',
                'contacts.notice' => 'This is a learning project: the address is an example and does not receive messages.',
            ],
        ];

        $language = $this->siteLanguage->get();

        return $translations[$language][$key] ?? $translations['ru'][$key] ?? $key;
    }
}
