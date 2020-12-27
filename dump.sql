--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

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
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: mbeauty
--

COPY public.admin (id, username, roles, password) FROM stdin;
1	admin	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$BQG+jovPcunctc30xG5PxQ$TiGbx451NKdo+g9vLtfkMy4KjASKSOcnNxjij4gTX1s
\.


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: mbeauty
--

COPY public.article (id, typename, typologiesystem, text, created_at, slug) FROM stdin;
2	Romantic-Dramatic	Dwyn Larson system	Type "Anxious" Romantic-Dramatic.\r\nStrong angular + delicate rounded beauty.\r\nYin inner lines with balanced outer lines (slight yang) - more reserved than a true Dramatic, follow Romantic guidelines, adding feminine dramatic accessories, but avoiding straight lines and looks that are too high fashion.	2020-12-23 16:41:00	romantic-dramatic
1	Gamine-Dramatic	Dwyn Larson system	Type "Expressive" Gamine + Dramatic.\r\nStrong angular + delicate angular beauty.\r\nShorter than Dramatics, but no less powerful. Choose clothing that holds its shape, not loose or oversized.\r\nGeometric or asymmetric styles with lots of color are best.	2020-12-23 16:38:00	gamine-dramatic
3	Natural-Dramatic	Dwyn Larson system	Type "Flaming" Dramatic + Natural\r\nStrong angular + strong rounded beauty.\r\nCan be "Grunge" - your desire for casual comfort may be holding you back; take dramatic risks with makeup and accessories, taking advantage of your height.	2020-12-23 16:43:00	natural-dramatic
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: mbeauty
--

COPY public.comment (id, article_id, author, text, email, created_at, state) FROM stdin;
1	1	Katya	cool stuff	k.k.katya@gmail.com	2020-12-23 18:00:00	published
2	1	Nina	it seems it is my type!	n.n.nina@gmail.com	2020-12-23 18:02:00	published
3	1	Sasha	i dont think those types really work	s.s.sasha@gmail.com	2020-12-23 18:10:00	published
4	1	Natasha	wow wee!\r\nWait for the suggestions in styling the clothes	n.m.oliinyk@gmail.com	2020-12-23 18:19:00	published
5	2	Lina	I am struggling to choose between the RD and GD.\r\nCan you tell the exact difference.	l.l.lina@gmail.com	2020-12-24 11:59:28	published
8	3	Nika	may work	n.n.nika@gmail.com	2020-12-25 13:02:19	submitted
9	1	Kira	awesome	k.k.kira@gmail.com	2020-12-25 13:27:39	submitted
10	1	Mila	everyone should understand his own lines	m.m.mila@gmail.com	2020-12-25 13:32:51	submitted
11	1	Lina	OMG! awesome	l.l.lina@gmail.com	2020-12-25 13:53:09	submitted
12	1	Nika	111	n.n.nika@gmail.com	2020-12-25 14:19:20	submitted
13	3	Kira	11122	k.k.kira@gmail.com	2020-12-25 15:28:16	published
14	3	Lina	11123	l.l.lina@gmail.com	2020-12-25 20:21:11	published
15	3	Lina	33	l.l.lina@gmail.com	2020-12-25 20:22:18	published
16	1	Nika	333	n.n.nika@gmail.com	2020-12-25 20:30:11	published
17	1	Lina	555	l.l.lina@gmail.com	2020-12-25 20:33:45	published
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: mbeauty
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20201223131833	2020-12-23 13:21:11	1012
DoctrineMigrations\\Version20201223210229	2020-12-23 21:08:48	444
DoctrineMigrations\\Version20201223211113	2020-12-23 21:11:26	497
DoctrineMigrations\\Version20201223215259	2020-12-23 21:53:25	138
DoctrineMigrations\\Version20201224123625	2020-12-24 12:37:58	2051
DoctrineMigrations\\Version20201224125933	2020-12-24 13:00:23	1538
DoctrineMigrations\\Version20201224150932	2020-12-24 15:10:12	268
DoctrineMigrations\\Version20201224221406	2020-12-24 22:16:16	1258
DoctrineMigrations\\Version20201225145921	2020-12-25 14:59:42	627
DoctrineMigrations\\Version20201225202641	2020-12-25 20:27:54	873
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mbeauty
--

SELECT pg_catalog.setval('public.admin_id_seq', 2, true);


--
-- Name: article_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mbeauty
--

SELECT pg_catalog.setval('public.article_id_seq', 3, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mbeauty
--

SELECT pg_catalog.setval('public.comment_id_seq', 17, true);


--
-- PostgreSQL database dump complete
--

