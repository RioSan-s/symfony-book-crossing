--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: points; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.points VALUES (4, '+7 (902) 685-24-76', '08:00:00', '20:00:00', 'Россия', 'Бузулук', 'Аналик', '4', 126);
INSERT INTO public.points VALUES (1, '+7 (962) 448-19-25', '09:00:00', '18:00:00', 'Россия', 'Уссурийск', 'Зеленая', '13', 200);
INSERT INTO public.points VALUES (5, '+7 (909) 961-24-65', '10:00:00', '19:00:00', 'Россия', 'Нижний Новгород', 'Березовская', '14', 113);
INSERT INTO public.points VALUES (3, '+7 (919) 961-24-65', '12:00:00', '16:00:00', 'Россия', 'Абакан', 'Пушкина', '6', 136);
INSERT INTO public.points VALUES (2, '+7 (963) 757-16-90', '10:00:00', '20:00:00', 'Россия', 'Уфа', 'Почтовая', '11', 34);


--
-- Data for Name: publication_house; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.publication_house VALUES (1, 'Эксмо', '1991-01-01', 'Александр Красовицкий');
INSERT INTO public.publication_house VALUES (2, 'АСТ', '1990-01-01', 'Олег Новиков');


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.books VALUES (5, 'Старик и море', 'Эрнест Хемингуэй', 1, 1, '2002-01-01');
INSERT INTO public.books VALUES (4, 'Собака Баскервилей', 'Артур Конан Дойль', 2, 2, '2020-01-01');
INSERT INTO public.books VALUES (2, 'Мёртвые души', 'Николай Гоголь', 2, 3, '2016-01-01');
INSERT INTO public.books VALUES (3, 'Евгений Онегин', 'Александр Пушкин', 1, 2, '2016-01-01');
INSERT INTO public.books VALUES (1, 'Мастер и Маргарита', 'Михаил Булгаков', 1, 1, '2021-01-01');


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES (1, 'Хигир Ирина Кузьминовна', '+7 (983) 604-51-60', '1973-04-15', 'participant');
INSERT INTO public.users VALUES (2, 'Курневича Елизавета Ефимовна', '+7 (953) 499-40-73', '1967-03-03', 'participant');
INSERT INTO public.users VALUES (3, 'Ясинская Марианна Климентьевна', '+7 (968) 528-41-17', '1984-12-10', 'participant');
INSERT INTO public.users VALUES (4, 'Булыгина Маргарита Никаноровна', '+7 (961) 179-12-24', '1990-06-25', 'participant');
INSERT INTO public.users VALUES (5, 'Лысова Антонина Егоровна', '+7 (929) 698-21-43', '1998-12-25', 'participant');
INSERT INTO public.users VALUES (6, 'Стрельцов Константин Юринович', '+7 (966) 211-77-49', '1983-03-02', 'participant');
INSERT INTO public.users VALUES (7, 'Бесфамильнов Максим Адамович', '+7 (963) 868-93-56', '1983-05-03', 'participant');
INSERT INTO public.users VALUES (8, 'Другаков Николай Егорович', '+7 (963) 974-86-15', '1972-05-24', 'admin');
INSERT INTO public.users VALUES (9, 'Вельдина Катерина Захаровна', '+7 (967) 674-75-89', '1978-09-03', 'admin');
INSERT INTO public.users VALUES (10, 'Болтунова Василиса', '+7 (919) 961-24-65', '1974-04-22', 'admin');
INSERT INTO public.users VALUES (11, 'Ковалевская Сюзанна Сергеевна', '+7 (974) 381-61-51', '1980-09-02', 'admin');
INSERT INTO public.users VALUES (12, 'Русских Виталий Гаврннлович', '+7 (997) 958-51-62', '1989-09-05', 'admin');


--
-- Data for Name: participants; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.participants VALUES (1, 'irina2888@rambler.ru');
INSERT INTO public.participants VALUES (2, 'elizaveta03031967@gmail.com');
INSERT INTO public.participants VALUES (3, 'marianna1984@ya.ru');
INSERT INTO public.participants VALUES (4, 'margarita1990@hotmail.com');
INSERT INTO public.participants VALUES (5, 'antonina1965@mail.ru');
INSERT INTO public.participants VALUES (6, 'konstantin1983@outlook.com');
INSERT INTO public.participants VALUES (7, 'maksim16@outlook.com');


--
-- Data for Name: act_of_giving; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.act_of_giving VALUES (1, 1, 1, 1);
INSERT INTO public.act_of_giving VALUES (2, 2, 1, 4);
INSERT INTO public.act_of_giving VALUES (3, 3, 1, 2);
INSERT INTO public.act_of_giving VALUES (4, 4, 1, 3);
INSERT INTO public.act_of_giving VALUES (5, 5, 1, 5);


--
-- Data for Name: act_of_taking; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.act_of_taking VALUES (30, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (31, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (32, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (33, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (34, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (35, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (36, 1, 3, 4);
INSERT INTO public.act_of_taking VALUES (37, 5, 1, 1);
INSERT INTO public.act_of_taking VALUES (38, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (39, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (43, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (40, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (41, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (44, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (46, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (48, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (50, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (54, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (56, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (58, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (60, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (72, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (73, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (74, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (75, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (76, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (77, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (79, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (80, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (81, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (96, 1, 4, 3);
INSERT INTO public.act_of_taking VALUES (97, 4, 2, 1);
INSERT INTO public.act_of_taking VALUES (98, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (99, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (100, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (101, 1, 1, 1);
INSERT INTO public.act_of_taking VALUES (6, 4, 1, 7);
INSERT INTO public.act_of_taking VALUES (7, 3, 1, 5);
INSERT INTO public.act_of_taking VALUES (8, 1, 1, 1);
INSERT INTO public.act_of_taking VALUES (29, 1, 4, 1);
INSERT INTO public.act_of_taking VALUES (102, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (103, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (104, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (105, 5, 1, 5);


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.admin VALUES (8, 1, 25000, 'admin1', '$2y$10$/PMscuC3phf6f6k1UdKkk.F1HAkgKF./oNrOrLXuGwkwSHVwReZ1q');
INSERT INTO public.admin VALUES (9, 2, 30000, 'admin2', '$2y$10$o7M73Yobl0IiYdAFzRWri.kFHi5a1nXIA/Sl5JkN54ep0oULDbV4S');
INSERT INTO public.admin VALUES (10, 1, 25000, 'admin3', '$2y$10$.mNXwd0pnLOxg2y41oyuqeTiOfwdJtGJdhg9RoCxZpSZno0orQjzG');
INSERT INTO public.admin VALUES (11, 3, 10000, 'admin4', '$2y$10$PY9utD1nS6oZOwZJPevE1uMe8H9texgfaiJvG33lW4ZOzCaDM/bqS');
INSERT INTO public.admin VALUES (12, 3, 10000, 'admin5', '$2y$10$ULC5LeqakqzJ9kYzIUwSxO2F.lAJ16NdD/MXSHr30huI6MUPKYnzu');


--
-- Data for Name: currency; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.currency VALUES (1, '643', 'RUB', 'Рубль');


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.doctrine_migration_versions VALUES ('NonEfTech\BookCrossing\Migrations\Version20220322163952', '2022-03-22 16:40:49', 53);


--
-- Data for Name: purchase_prices; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.purchase_prices VALUES (1, '2021-08-30 00:00:00', 28940, 1, 16);
INSERT INTO public.purchase_prices VALUES (2, '2021-04-09 00:00:00', 14252, 1, 17);
INSERT INTO public.purchase_prices VALUES (3, '2021-07-27 00:00:00', 43000, 1, 18);
INSERT INTO public.purchase_prices VALUES (4, '2021-11-10 00:00:00', 12000, 1, 19);
INSERT INTO public.purchase_prices VALUES (5, '2021-10-31 00:00:00', 73200, 1, 20);


--
-- Name: act_of_taking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.act_of_taking_id_seq', 105, true);


--
-- Name: book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_id_seq', 5, true);


--
-- Name: currency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.currency_id_seq', 1, true);


--
-- Name: points_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.points_id_seq', 5, true);


--
-- Name: publication_house_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.publication_house_id_seq', 2, true);


--
-- Name: purchase_prices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_prices_id_seq', 20, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 12, true);


--
-- PostgreSQL database dump complete
--

