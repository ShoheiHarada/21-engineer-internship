
INSERT INTO `category` (`category_id`, `category_name`, `room_count`, `delete_flag`, `created_date`, `updated_date`) VALUES
	(1, '雑談', 4, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(2, 'ブログ', 3, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(3, '集まれ', 3, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(4, '野望', 1, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(5, '趣味', 0, 1, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(6, '職業', 0, 1, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(7, 'その他', 1, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(8, '質問', 1, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(9, 'まとめ', 0, 1, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(10, 'ニュース', 2, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12');

INSERT INTO `comment` (`comment_id`, `room_id`, `user_id`, `comment_body`, `destination_id`, `comment_text1`, `comment_text2`, `comment_flag1`, `comment_flag2`, `delete_flag`, `created_date`, `updated_date`) VALUES
	(1, 1, 1, 'みんなどう思う？\r\nエンジニアの需要って年々高まってきてる気がする。', 0, '', '', 0, 0, 0, '2020-01-25 17:07:16', '2020-01-25 17:07:16'),
	(2, 1, 2, 'それはどうかな。\r\nエンジニアにも色々あるし。', 1, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(3, 1, 3, '俺もエンジニアになりたいけど結構ハードル高そう。', 1, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(4, 1, 10, 'ITエンジニアになりたいんだが、何から勉強したらいいか教えてくれ。', 0, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(5, 1, 9, 'PHP、SQLとかできたらWEBエンジニアなれるで。', 10, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(6, 1, 10, 'まじか！\r\nなんか両方教えてもらえるインターンあるらしいから応募してみるわ！', 9, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(7, 1, 10, 'まじか！\r\n俺も行くわそれ！', 10, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(8, 2, 2, '興味ありませんか。', 0, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(9, 2, 4, '教えてほしいです！', 2, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(10, 2, 2, 'いいですよ！\r\nでは、手数料として1000円いただけますか。', 4, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(11, 2, 4, 'ありがとうございます！\r\n振り込みました！', 2, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(12, 2, 2, '確認しました。\r\nでは教えます。\r\n\r\n①このチャットシステムで部屋を作ります。\r\n②私と同じように10名限定に楽に稼げる方法を教えるという部屋を作ります。\r\n③10名に1000円ずつ貰えば1万円になります。\r\n\r\nうまく行けば実働10分で10名いきます。\r\n以上です。', 4, '', '', 0, 0, 0, '2020-01-25 17:20:31', '2020-01-25 17:20:31'),
	(13, 2, 1, 'がっつりねずみ講詐欺やんけ！', 0, '', '', 0, 0, 0, '2020-01-27 12:55:31', '2020-01-27 12:55:31'),
	(14, 3, 1, 'コダックは可愛いけど、アホっぽいのがね。。。', 0, '', '', 0, 0, 0, '2020-01-27 14:32:11', '2020-01-27 14:32:11'),
	(15, 4, 8, 'いうほどユニバが負けてる感じはしないけどなあ', 0, '', '', 0, 0, 0, '2020-01-27 14:33:37', '2020-01-27 14:33:37'),
	(16, 4, 4, 'でもプレゼントにするのは、ユニバの年パス＜ディズニーチケットだろ。', 8, '', '', 0, 0, 0, '2020-01-27 14:34:31', '2020-01-27 14:34:31'),
	(17, 4, 8, '金額がねぇ', 3, '', '', 0, 0, 0, '2020-01-27 14:34:41', '2020-01-27 14:34:41'),
	(18, 5, 1, '就活始めたばっかりだから、まだ面接の感じとかもわからなくて辛い。\r\n圧迫面接とかってまだあるんですか？', 0, '', '', 0, 0, 0, '2020-01-27 14:36:29', '2020-01-27 14:36:29'),
	(19, 5, 10, '最近は減ってる気がするけど、どうなんだろ？', 1, '', '', 0, 0, 0, '2020-01-27 14:39:34', '2020-01-27 14:39:34'),
	(20, 6, 1, 'カスタネットできます。', 0, '', '', 0, 0, 0, '2020-01-27 14:40:39', '2020-01-27 14:40:39'),
	(21, 6, 10, '鍵盤ハーモニカやりたいです！', 0, '', '', 0, 0, 0, '2020-01-27 14:41:20', '2020-01-27 14:41:20'),
	(22, 7, 2, 'リアル脱出ゲームやりたいな', 0, '', '', 0, 0, 0, '2020-01-27 14:42:05', '2020-01-27 14:42:05'),
	(23, 7, 8, '1000人で同時にジャンプして震度3の地震を起こそう', 0, '', '', 0, 0, 0, '2020-01-27 14:43:37', '2020-01-27 14:43:37'),
	(24, 7, 1, '4足歩行マラソン大会', 0, '', '', 0, 0, 0, '2020-01-27 14:46:08', '2020-01-27 14:46:08'),
	(25, 8, 6, '物理封鎖かよw', 0, '', '', 0, 0, 0, '2020-01-27 18:32:38', '2020-01-27 18:32:38'),
	(26, 8, 7, 'ガバガバ封鎖やな', 0, '', '', 0, 0, 0, '2020-01-27 18:32:51', '2020-01-27 18:32:51'),
	(27, 8, 4, 'もっと高い壁を作れよ', 0, '', '', 0, 0, 0, '2020-01-27 18:33:04', '2020-01-27 18:33:04'),
	(28, 8, 1, '横からすり抜けれられるやんw', 0, '', '', 0, 0, 0, '2020-01-27 18:33:30', '2020-01-27 18:33:30'),
	(29, 8, 2, '岩は持ってくるのも除去すんのも大変だろうに', 0, '', '', 0, 0, 0, '2020-01-27 18:33:38', '2020-01-27 18:33:38'),
	(30, 8, 3, '本当に経済力世界第2位の国家かよと思うくらいの途上国感\r\n', 0, '', '', 0, 0, 1, '2020-01-27 18:33:51', '2020-01-27 18:33:56'),
	(31, 8, 5, 'もうfalloutの世界みたいでカッコいい', 0, '', '', 0, 0, 0, '2020-01-27 18:34:33', '2020-01-27 18:34:33'),
	(32, 8, 7, '監視でもいないとぶっちゃけザル', 0, '', '', 0, 0, 0, '2020-01-27 18:34:42', '2020-01-27 18:34:42'),
	(33, 8, 10, '無理矢理入ろうとしたやつが殺されるっていうパニック映画の定番', 0, '', '', 0, 0, 0, '2020-01-27 18:35:20', '2020-01-27 18:35:20'),
	(34, 8, 2, 'これ見ると相当やばいんだと思う', 0, '', '', 0, 0, 0, '2020-01-27 18:35:32', '2020-01-27 18:35:32'),
	(35, 8, 8, 'サバイバーなら余裕で山から出れるだろ', 0, '', '', 0, 0, 0, '2020-01-27 18:35:46', '2020-01-27 18:35:57'),
	(36, 9, 10, 'いきなり再開', 0, '', '', 0, 0, 0, '2020-01-27 18:40:02', '2020-01-27 18:40:02'),
	(37, 9, 3, 'うそつきステーキ', 0, '', '', 0, 0, 0, '2020-01-27 18:40:10', '2020-01-27 18:40:10'),
	(38, 9, 1, '年末に40億くらい借り入れてるから何とかなったのかもな', 0, '', '', 0, 0, 0, '2020-01-27 18:40:22', '2020-01-27 18:40:43'),
	(39, 9, 7, '4000円でまずい肉一時間食べ放題', 0, '', '', 0, 0, 0, '2020-01-27 18:40:51', '2020-01-27 18:40:51'),
	(40, 9, 9, '閉店する(閉店するとは言ってない)', 0, '', '', 0, 0, 0, '2020-01-27 18:40:57', '2020-01-27 18:40:57'),
	(41, 9, 7, '閉めないステーキ', 0, '', '', 0, 0, 0, '2020-01-27 18:41:03', '2020-01-27 18:41:03'),
	(42, 9, 5, 'ステーキ詐欺', 0, '', '', 0, 0, 0, '2020-01-27 18:41:15', '2020-01-27 18:41:15'),
	(43, 9, 7, 'また開店しただけ', 0, '', '', 0, 0, 0, '2020-01-27 18:41:26', '2020-01-27 18:41:26'),
	(44, 9, 5, 'いついつまでに楽天カード作ると○○ポイントつきますって次から次にやってるしな', 7, '', '', 0, 0, 0, '2020-01-27 18:41:37', '2020-01-27 18:41:37'),
	(45, 9, 10, '閉店セール年中やってるような店もあるからセーフ', 0, '', '', 0, 0, 0, '2020-01-27 18:41:51', '2020-01-27 18:41:51'),
	(46, 9, 4, '洋服の青山も年中閉店セールしてるしな', 0, '', '', 0, 0, 0, '2020-01-27 18:42:04', '2020-01-27 18:42:04'),
	(47, 9, 2, 'いきなりふけーき', 0, '', '', 0, 0, 0, '2020-01-27 18:42:11', '2020-01-27 18:42:11'),
	(48, 9, 8, 'うそつきステーキ', 0, '', '', 0, 0, 0, '2020-01-27 18:42:18', '2020-01-27 18:42:18'),
	(49, 10, 2, '(ハム)カツサンドな', 0, '', '', 0, 0, 0, '2020-01-27 18:44:48', '2020-01-27 18:44:48'),
	(50, 10, 3, 'その中でもエビカツサンド', 0, '', '', 0, 0, 0, '2020-01-27 18:44:53', '2020-01-27 18:44:53'),
	(51, 10, 4, '卵やろ', 0, '', '', 0, 0, 0, '2020-01-27 18:44:59', '2020-01-27 18:44:59'),
	(52, 10, 5, 'ハムカツな', 0, '', '', 0, 0, 0, '2020-01-27 18:45:05', '2020-01-27 18:45:05'),
	(53, 10, 6, 'ローストビーフ「フンッ」', 0, '', '', 0, 0, 0, '2020-01-27 18:45:10', '2020-01-27 18:45:10'),
	(54, 10, 7, 'ハムカツ派多すぎジジイかよ>', 0, '', '', 0, 0, 0, '2020-01-27 18:45:15', '2020-01-27 18:45:15'),
	(55, 10, 8, 'ストロベリーサンドやぞ', 0, '', '', 0, 0, 0, '2020-01-27 18:45:21', '2020-01-27 18:45:21'),
	(56, 10, 9, 'BLTとか言う意識高い系馬鹿御用達サンド', 0, '', '', 0, 0, 0, '2020-01-27 18:45:27', '2020-01-27 18:45:27'),
	(57, 10, 10, 'そこまでいくとハンバーガーでいいよねとはなる', 9, '', '', 0, 0, 0, '2020-01-27 18:45:34', '2020-01-27 18:45:34'),
	(58, 10, 1, 'サバカツサンドだぞ', 0, '', '', 0, 0, 0, '2020-01-27 18:45:46', '2020-01-27 18:45:46'),
	(59, 10, 2, 'ツナサンド、な？', 0, '', '', 0, 0, 0, '2020-01-27 18:45:57', '2020-01-27 18:45:57'),
	(60, 10, 3, 'クラブハウスサンド最強ですわ>', 0, '', '', 0, 0, 0, '2020-01-27 18:46:07', '2020-01-27 18:46:07'),
	(61, 10, 4, 'ジャ、ジャムサンド…', 0, '', '', 0, 0, 0, '2020-01-27 18:46:14', '2020-01-27 18:46:14'),
	(62, 10, 5, '海老カツやぞ', 0, '', '', 0, 0, 0, '2020-01-27 18:46:21', '2020-01-27 18:46:21'),
	(63, 11, 6, 'ライフガード\r\nリポビタンD\r\n\r\nまぢおぬぬめ', 0, '', '', 0, 0, 0, '2020-01-27 18:47:26', '2020-01-27 18:47:26'),
	(64, 11, 7, '水が一番', 0, '', '', 0, 0, 0, '2020-01-27 18:47:30', '2020-01-27 18:47:30'),
	(65, 11, 8, 'お湯でいいと思うよ\r\nジュースで割らないと飲めないようなら\r\n無理して飲まなくていいよ', 0, '', '', 0, 0, 0, '2020-01-27 18:47:37', '2020-01-27 18:47:37'),
	(66, 11, 9, 'うちの親父は牛乳で割ってたぞ', 0, '', '', 0, 0, 0, '2020-01-27 18:47:44', '2020-01-27 18:47:44'),
	(67, 11, 10, 'オロナミンC\r\nサイコー', 0, '', '', 0, 0, 0, '2020-01-27 18:47:48', '2020-01-27 18:47:48'),
	(68, 11, 1, '上級者は焼酎を焼酎で割るんだぜ…', 0, '', '', 0, 0, 0, '2020-01-27 18:47:54', '2020-01-27 18:47:54'),
	(69, 11, 2, '混ぜたら悪酔いしそうだな', 1, '', '', 0, 0, 0, '2020-01-27 18:48:02', '2020-01-27 18:48:02'),
	(70, 11, 3, '烏龍ハイが最高', 0, '', '', 0, 0, 0, '2020-01-27 18:48:09', '2020-01-27 18:48:09'),
	(71, 11, 4, '友達に焼酎まむしドリンク割り飲ませたら、その夜大変な事になった', 0, '', '', 0, 0, 0, '2020-01-27 18:48:17', '2020-01-27 18:48:17'),
	(72, 11, 5, '友達のまむしが大蛇に化けたんですね、わかります', 4, '', '', 0, 0, 0, '2020-01-27 18:48:23', '2020-01-27 18:48:23'),
	(73, 11, 6, 'ビールおすすめ\r\n飲み会でビール飽きてきたら、余ったヤツに焼酎足して', 0, '', '', 0, 0, 0, '2020-01-27 18:48:46', '2020-01-27 18:48:46'),
	(74, 11, 7, 'ホッピーでいいじゃん', 6, '', '', 0, 0, 0, '2020-01-27 18:48:52', '2020-01-27 18:48:52'),
	(75, 11, 8, 'ワインで割ってるおっさんは見たことある', 0, '', '', 0, 0, 0, '2020-01-27 18:48:58', '2020-01-27 18:48:58'),
	(76, 11, 9, '一番いいのはロックだけど\r\nどうしても割りたいんなら水＋キュウリスライスが美味い\r\n水以外なら牛乳かな', 0, '', '', 0, 0, 0, '2020-01-27 18:49:03', '2020-01-27 18:49:03'),
	(77, 11, 10, '日本酒で割るといいよ', 0, '', '', 0, 0, 0, '2020-01-27 18:49:10', '2020-01-27 18:49:10'),
	(78, 11, 1, 'オロナミンCで割る\r\n\r\nパンチサワーの出来上がり！最高！！！！', 0, '', '', 0, 0, 0, '2020-01-27 18:49:20', '2020-01-27 18:49:20'),
	(79, 11, 2, 'ポカリとかアクエリで割るといいよ！\r\n\r\n浸透率が変わってあばばばば', 0, '', '', 0, 0, 0, '2020-01-27 18:49:25', '2020-01-27 18:49:25'),
	(80, 11, 3, '午後の紅茶のストレート割りは神', 0, '', '', 0, 0, 0, '2020-01-27 18:49:33', '2020-01-27 18:49:33'),
	(81, 11, 4, 'きゅうりの薄切りを入れて水割り', 0, '', '', 0, 0, 0, '2020-01-27 18:49:39', '2020-01-27 18:49:39'),
	(82, 11, 5, 'おまえらは魔王とか旨い焼酎でもなんか甘いので割ったりすんのか…？', 0, '', '', 0, 0, 0, '2020-01-27 18:49:47', '2020-01-27 18:49:47'),
	(83, 11, 6, '高いのは普通ストレートかロック\r\n割って飲んでもうまそうではあるけどもったいない気がするな', 5, '', '', 0, 0, 0, '2020-01-27 18:49:56', '2020-01-27 18:49:56'),
	(84, 11, 7, 'ポカリかコーラだな。', 0, '', '', 0, 0, 0, '2020-01-27 18:50:01', '2020-01-27 18:50:01'),
	(85, 11, 8, '今の季節ロックでいいんでねぇの', 0, '', '', 0, 0, 0, '2020-01-27 18:50:07', '2020-01-27 18:50:07'),
	(86, 11, 9, '単純に\r\n氷＋水＋レモンスライス\r\n\r\nもしくは\r\n氷＋水＋かぼす\r\n\r\nさらに\r\n氷＋水＋カクテルで使うライムのシロップみたいなやつ\r\n\r\nまぁ、これからの季節はこんなもんだな。\r\n寒い時期は黙ってお湯割り飲んどけ。', 0, '', '', 0, 0, 0, '2020-01-27 18:50:14', '2020-01-27 18:50:14'),
	(87, 11, 10, '乙なら水以外はありえん\r\n甲ならペプシネックス', 0, '', '', 0, 0, 0, '2020-01-27 18:50:24', '2020-01-27 18:50:24'),
	(88, 11, 1, '甘いホットミルクも何気に好き', 0, '', '', 0, 0, 0, '2020-01-27 18:50:36', '2020-01-27 18:50:36'),
	(89, 11, 2, '生レモンと生オレンジのしぼり汁 ガチで', 0, '', '', 0, 0, 0, '2020-01-27 18:52:21', '2020-01-27 18:52:21'),
	(90, 11, 3, '湯＋梅干し\r\n\r\n何で居ないんだ…', 0, '', '', 0, 0, 0, '2020-01-27 18:52:27', '2020-01-27 18:52:27'),
	(91, 11, 4, '黒霧島は牛乳割りおいすいよ', 0, '', '', 0, 0, 0, '2020-01-27 18:52:31', '2020-01-27 18:52:31'),
	(92, 11, 5, 'コーヒーがいいかな', 0, '', '', 0, 0, 0, '2020-01-27 18:52:35', '2020-01-27 18:52:35'),
	(93, 12, 10, '1日1時間まで', 0, '', '', 0, 0, 0, '2020-01-28 11:24:55', '2020-01-28 11:24:55'),
	(94, 12, 9, '平日30分\r\n休日1時間', 0, '', '', 0, 0, 0, '2020-01-28 11:24:59', '2020-01-28 11:24:59'),
	(95, 12, 1, '躾できない親が増え過ぎた', 0, '', '', 0, 0, 0, '2020-01-28 11:25:03', '2020-01-28 11:25:03'),
	(96, 12, 2, '親がコントロールすれば良いだけなのにね\r\n出来ないなら買い与えない方がいい', 1, '', '', 0, 0, 0, '2020-01-28 11:25:13', '2020-01-28 11:25:13'),
	(97, 12, 8, '休日は3時間までだよね', 0, '', '', 0, 0, 0, '2020-01-28 11:25:18', '2020-01-28 11:25:18'),
	(98, 12, 7, '英語や数学ゲームなら良いよ', 0, '', '', 0, 0, 0, '2020-01-28 11:25:23', '2020-01-28 11:25:23'),
	(99, 12, 3, '規制するまでもなく、親が買い与えなきゃいいんじゃないの？\r\nゲーム機は買わなければいいし、スマホはネット接続できないようにすれば\r\nこんな各家庭の話し合えば解決しそうな、親の躾レベルのことを行政に規制させる意味よ…', 0, '', '', 0, 0, 0, '2020-01-28 11:25:28', '2020-01-28 11:25:28'),
	(100, 12, 4, 'それ言うと、そういう子は友達のゲーム機離さなくて困るってコメント来そう', 3, '', '', 0, 0, 0, '2020-01-28 11:25:33', '2020-01-28 11:25:33'),
	(101, 12, 6, '自治体の条例より、親が規制すべきだよね。', 0, '', '', 0, 0, 0, '2020-01-28 11:25:39', '2020-01-28 11:25:39'),
	(102, 12, 5, 'それ、そんなことまで条令で決めなきゃダメ？っておもうわ', 6, '', '', 0, 0, 0, '2020-01-28 11:25:44', '2020-01-28 11:25:44'),
	(103, 12, 10, '今の子供は目が悪い子増えたね。', 0, '', '', 0, 0, 0, '2020-01-28 11:25:50', '2020-01-28 11:25:50'),
	(104, 12, 9, '理想は1日1時間1時間まで。でもキリよく終われるゲームならいいんだけど、なんでゲームってあんな中毒性あるんだろう。', 0, '', '', 0, 0, 0, '2020-01-28 11:25:57', '2020-01-28 11:25:57'),
	(105, 12, 1, 'やることやったらゲームしていいよとか、メリハリが大事と思う', 0, '', '', 0, 0, 0, '2020-01-28 11:26:02', '2020-01-28 11:26:02'),
	(106, 12, 2, 'RPGとか一人でゆったりやるゲームならいいけど、オンラインはね～。\r\n粗暴な無職引きこもりとかしつけの出来てない不登校児がたくさん居るからそういうのと関わって欲しくない。', 0, '', '', 0, 0, 0, '2020-01-28 11:26:10', '2020-01-28 11:26:10'),
	(107, 12, 8, 'まず与えたの誰よ…', 0, '', '', 0, 0, 0, '2020-01-28 11:26:15', '2020-01-28 11:26:15'),
	(108, 12, 7, '子供がゲームばっかして勉強しないだのニートになっただの愚痴る親に限って、最新のゲーム機を発売後すぐに買ってやってる、もしくは買うためのお小遣いあげてる傾向ない？\r\n愚痴りつつ、本当はどうでもいいと思ってるんじゃん', 0, '', '', 0, 0, 0, '2020-01-28 11:26:30', '2020-01-28 11:26:30'),
	(109, 12, 3, 'ゲームってステージとかあるから時間で区切れないんだよね', 0, '', '', 0, 0, 0, '2020-01-28 11:26:40', '2020-01-28 11:26:40'),
	(110, 12, 4, '人に規制してもらわなきゃ教育も出来ないんだね', 0, '', '', 0, 0, 0, '2020-01-28 11:26:45', '2020-01-28 11:26:45'),
	(111, 12, 6, '海外の親子で、父親がゲームに関してのミッションを息子に毎日出していくと(今日はこの町まで進め、このボスまで倒せ等)ゲームがしんどくなってやらなくなったって記事を昔見たよ。', 0, '', '', 0, 0, 0, '2020-01-28 11:26:57', '2020-01-28 11:26:57'),
	(112, 12, 5, 'ゲーマーがゲームを擁護するトピがまた立った\r\n倉庫でバイトしたことあるけど若年層はゲームの話ばっかりだったよ\r\n休み時間とか電車の中でも集まってゲームしてたな\r\n頭悪い悪いイメージしかない', 0, '', '', 0, 0, 0, '2020-01-28 11:27:09', '2020-01-28 11:27:09'),
	(113, 12, 10, '倉庫バイトの身分で他人を見下すとか笑える', 5, '', '', 0, 0, 0, '2020-01-28 11:27:15', '2020-01-28 11:27:15'),
	(114, 12, 9, '時間になったら自動的に切れる設定とかないの', 0, '', '', 0, 0, 0, '2020-01-28 11:27:24', '2020-01-28 11:27:24'),
	(115, 12, 1, '各家庭で決めること\r\n法律や条例で決める必要ない\r\nむしろ家庭でこれぐらいのことも決められないようなのが、人の親になっちゃダメ', 0, '', '', 0, 0, 0, '2020-01-28 11:27:32', '2020-01-28 11:27:32'),
	(116, 12, 2, 'しつけ出来ないから国が規制してくださいって？\r\n何で自ら中国みたいな国にしてほしがってんのか意味わからない', 0, '', '', 0, 0, 0, '2020-01-28 11:27:38', '2020-01-28 11:27:38'),
	(117, 13, 8, '流石日本人やね', 0, '', '', 0, 0, 0, '2020-01-30 17:33:19', '2020-01-30 17:33:19'),
	(118, 13, 6, '両津ならもっとうまくやる', 0, '', '', 0, 0, 0, '2020-01-30 17:33:27', '2020-01-30 17:33:27'),
	(119, 13, 9, 'マスクの価値カンストで草', 0, '', '', 0, 0, 0, '2020-01-30 17:33:33', '2020-01-30 17:33:33'),
	(120, 13, 3, '買う中国人いるかな', 0, '', '', 0, 0, 0, '2020-01-30 17:33:39', '2020-01-30 17:33:39'),
	(121, 13, 5, 'それって個数とかで専用作るから\r\n注文できないようにしてるんじゃ', 0, '', '', 0, 0, 0, '2020-01-30 17:33:44', '2020-01-30 17:33:44'),
	(122, 13, 6, '何箱買うかコメントして専用出品してもらうタイプのやつかな', 0, '', '', 0, 0, 0, '2020-01-30 17:33:49', '2020-01-30 17:33:49'),
	(123, 13, 10, 'でもすごい値段で売れるんやな', 0, '', '', 0, 0, 0, '2020-01-30 17:34:12', '2020-01-30 17:34:12'),
	(124, 13, 4, 'なんやこれボロ儲けやん', 0, '', '', 0, 0, 0, '2020-01-30 17:34:18', '2020-01-30 17:34:18'),
	(125, 13, 4, 'うわぁボロい商売だあ', 0, '', '', 0, 0, 0, '2020-01-30 17:34:26', '2020-01-30 17:34:26'),
	(126, 13, 8, '普通に店にいけば売ってるのに', 0, '', '', 0, 0, 0, '2020-01-30 17:34:35', '2020-01-30 17:34:35'),
	(127, 13, 4, 'サイン転売よりこっちを問題視しろよ', 0, '', '', 0, 0, 0, '2020-01-30 17:34:47', '2020-01-30 17:34:47'),
	(128, 13, 10, 'なんで買っちゃうんだよ', 0, '', '', 0, 0, 0, '2020-01-30 17:34:51', '2020-01-30 17:34:51'),
	(129, 13, 6, 'はえーワイもやろうかな', 0, '', '', 0, 0, 0, '2020-01-30 17:34:56', '2020-01-30 17:34:56'),
	(130, 13, 3, 'ええやん！\r\n馬鹿から金儲けして賢いわ', 0, '', '', 0, 0, 0, '2020-01-30 17:35:01', '2020-01-30 17:35:01'),
	(131, 13, 9, '頭悪い奴にとっては転売が1番楽に稼げるんやろうな', 0, '', '', 0, 0, 0, '2020-01-30 17:35:07', '2020-01-30 17:35:07'),
	(132, 13, 6, 'こりゃうめぇからワイもやるわw', 0, '', '', 0, 0, 0, '2020-01-30 17:35:11', '2020-01-30 17:35:11'),
	(133, 13, 7, 'うめぇw', 0, '', '', 0, 0, 0, '2020-01-30 17:35:17', '2020-01-30 17:35:17'),
	(134, 13, 4, 'ええんか？', 0, '', '', 0, 0, 0, '2020-01-30 17:35:22', '2020-01-30 17:35:22'),
	(135, 13, 5, 'なんで専用ついてんねんどうせひやかしやろ', 0, '', '', 0, 0, 0, '2020-01-30 17:35:27', '2020-01-30 17:35:27'),
	(136, 13, 6, 'マスクは拡散を防ぐだけやのにw\r\n感染してないやつが買う理由w', 0, '', '', 0, 0, 0, '2020-01-30 17:35:34', '2020-01-30 17:35:34'),
	(137, 13, 7, '多少は予防に効果あるぞ', 0, '', '', 0, 0, 0, '2020-01-30 17:35:39', '2020-01-30 17:35:39'),
	(138, 13, 1, 'マスク買い占めて売っただけで年収稼げたわ', 0, '', '', 0, 0, 0, '2020-01-30 17:35:44', '2020-01-30 17:35:44'),
	(139, 13, 10, 'ニートにはわからんかもしれんけど会社で義務付けられてる所多いから全然足りんやろな', 0, '', '', 0, 0, 0, '2020-01-30 17:35:48', '2020-01-30 17:35:48'),
	(140, 13, 2, '義務付けてるところは会社から支給あるだろ', 0, '', '', 0, 0, 0, '2020-01-30 17:35:55', '2020-01-30 17:35:55'),
	(141, 13, 8, '転売で家が建つんや', 0, '', '', 0, 0, 0, '2020-01-30 17:35:59', '2020-01-30 17:35:59'),
	(142, 13, 7, 'マスク作る作業するわ', 0, '', '', 0, 0, 0, '2020-01-30 17:36:04', '2020-01-30 17:36:04'),
	(143, 13, 9, 'ちゃんとメルカリ見てみろよライバル多すぎて高値じゃ売れんて', 0, '', '', 0, 0, 0, '2020-01-30 17:36:08', '2020-01-30 17:36:08'),
	(144, 13, 2, 'シーズンやし在庫抱えるだkりゃぞ', 0, '', '', 0, 0, 0, '2020-01-30 17:36:16', '2020-01-30 17:36:16'),
	(145, 13, 1, 'ドラッグストアで買い占めてる中国人も本国で転売するんやろか？', 0, '', '', 0, 0, 0, '2020-01-30 17:36:22', '2020-01-30 17:36:22'),
	(146, 13, 4, '本国では1箱1万やぞ、', 0, '', '', 0, 0, 0, '2020-01-30 17:36:33', '2020-01-30 17:36:33'),
	(147, 13, 1, '今売るのは気が早くないか？\r\n一ヶ月後くらいまで出し惜しんだ方がいいだろ花粉症とも被るし', 0, '', '', 0, 0, 0, '2020-01-30 17:36:38', '2020-01-30 17:36:38'),
	(148, 13, 2, '一ヶ月後にはコロナなんて忘れとるぞ', 0, '', '', 0, 0, 0, '2020-01-30 17:36:44', '2020-01-30 17:36:44'),
	(149, 13, 8, '花粉症のワイ、店にマスクがなくて怒り狂う', 0, '', '', 0, 0, 0, '2020-01-30 17:36:50', '2020-01-30 17:36:50'),
	(150, 13, 3, 'どこぞとしれんマスクが1万で売れるなら\r\nワイが持ってる三次元マスクはもっと高く売れるな', 0, '', '', 0, 0, 0, '2020-01-30 17:36:56', '2020-01-30 17:36:56'),
	(151, 13, 9, 'アマで9000円で取引されてるぞ\r\n今すぐ転売や', 0, '', '', 0, 0, 0, '2020-01-30 17:37:02', '2020-01-30 17:37:02'),
	(152, 13, 6, 'うせやろ？\r\nワイ200枚は持ってるわ', 0, '', '', 0, 0, 0, '2020-01-30 17:37:08', '2020-01-30 17:37:08'),
	(153, 13, 1, '一番売れてるのはユニ・チャームとかが作ってるメイドインジャパンの刻印されてる奴やな\r\n中国人が狂ったように買ってる', 0, '', '', 0, 0, 0, '2020-01-30 17:37:13', '2020-01-30 17:37:13'),
	(154, 13, 4, 'でもこういう時にマスクを高く売るのがわかりやすい商売の基本よな', 0, '', '', 0, 0, 0, '2020-01-30 17:37:16', '2020-01-30 17:37:16'),
	(155, 13, 3, '病院に置いてるN95マスクをメルカリに出品して金儲けしている医療従事者はおらんやろな？', 0, '', '', 0, 0, 0, '2020-01-30 17:37:23', '2020-01-30 17:37:23'),
	(156, 13, 9, 'ええやん', 0, '', '', 0, 0, 0, '2020-01-30 17:37:31', '2020-01-30 17:37:31'),
	(157, 14, 3, 'でしょうね', 0, '', '', 0, 0, 0, '2020-01-30 17:40:41', '2020-01-30 17:40:41'),
	(158, 14, 6, '月面着陸する前に不時着してどないすねん！', 0, '', '', 0, 0, 0, '2020-01-30 17:40:45', '2020-01-30 17:40:45'),
	(159, 14, 5, '金に釣られて騙されやすい豚の個人情報が集まってよかったね', 0, '', '', 0, 0, 0, '2020-01-30 17:40:51', '2020-01-30 17:40:51'),
	(160, 14, 6, '真剣お見合いドタキャン', 0, '', '', 0, 0, 0, '2020-01-30 17:40:56', '2020-01-30 17:40:56'),
	(161, 14, 2, 'その女どもにバトルロワイヤルさせたほうが視聴率取れる。', 0, '', '', 0, 0, 0, '2020-01-30 17:40:59', '2020-01-30 17:40:59'),
	(162, 14, 1, '女は金で買えるんだな', 0, '', '', 0, 0, 0, '2020-01-30 17:41:03', '2020-01-30 17:41:03'),
	(163, 14, 7, '釣れた釣れたってか', 0, '', '', 0, 0, 0, '2020-01-30 17:41:10', '2020-01-30 17:41:10'),
	(164, 14, 2, 'これは巧妙な罠', 0, '', '', 0, 0, 0, '2020-01-30 17:41:14', '2020-01-30 17:41:14'),
	(165, 14, 10, '馬鹿女どもざまぁwwwww\r\n金に目が眩んで個人情報抜かれてどんな気持ち？(笑)', 0, '', '', 0, 0, 0, '2020-01-30 17:41:20', '2020-01-30 17:41:20'),
	(166, 14, 7, '仮に放送したとして何クールになるのか', 0, '', '', 0, 0, 0, '2020-01-30 17:41:25', '2020-01-30 17:41:25'),
	(167, 14, 3, '知ってた', 0, '', '', 0, 0, 0, '2020-01-30 17:41:29', '2020-01-30 17:41:29'),
	(168, 14, 10, 'やはりお金って大事、、、まあこの人の場合、規格外やけれども、、、', 0, '', '', 0, 0, 0, '2020-01-30 17:41:34', '2020-01-30 17:41:34'),
	(169, 14, 3, 'まあ、そりゃそうだろ\r\nアベマの恋愛リアリティショーはそれなりに面白いけど、この企画は無理やわ', 0, '', '', 0, 0, 0, '2020-01-30 17:41:40', '2020-01-30 17:41:40'),
	(170, 14, 3, '書類審査だけでもめっちゃ時間かかりそうだもんなあ', 0, '', '', 0, 0, 0, '2020-01-30 17:41:52', '2020-01-30 17:41:52'),
	(171, 14, 3, 'さすがのスーパー図太い神経の前澤氏でも\r\nドン引きしたのかwwwwwwww\r\n凄いなw', 0, '', '', 0, 0, 0, '2020-01-30 17:41:57', '2020-01-30 17:41:57'),
	(172, 14, 4, '無人島で鬼ごっこして欲しかった', 0, '', '', 0, 0, 0, '2020-01-30 17:42:01', '2020-01-30 17:42:01'),
	(173, 14, 5, 'そんだけいれば剛力以上の女くらい数百人は居そうなもんだが', 0, '', '', 0, 0, 0, '2020-01-30 17:42:06', '2020-01-30 17:42:06'),
	(174, 14, 7, '金目当てでしかあなたを見てない何千何万との女性が殺到したら\r\nそりゃーおののくわなw', 0, '', '', 0, 0, 0, '2020-01-30 17:42:10', '2020-01-30 17:42:10'),
	(175, 14, 1, '前澤さん的には結婚しないほうがいい人を炙り出せたのでOK', 0, '', '', 0, 0, 0, '2020-01-30 17:42:15', '2020-01-30 17:42:15'),
	(176, 14, 8, 'イケメンだったり、人柄が良かったり（テレビとかのイメージでしかないけど）そういった面があれば\r\nまだ理解できるけど\r\n\r\n金持ってるおっさんなだけだから、純粋に女が金目当てに群がってるのが目に見えてキツイな', 0, '', '', 0, 0, 0, '2020-01-30 17:42:23', '2020-01-30 17:42:23'),
	(177, 14, 8, 'どんな気持ちで応募したんやろな。\r\n\r\nほんとゲスなやつらだわ。', 0, '', '', 0, 0, 0, '2020-01-30 17:42:30', '2020-01-30 17:42:30'),
	(178, 14, 2, '本当にお見合いしたとしても\r\n相手の目はあなたを見ず、あなたの後ろにあるお金しか見てないよw', 0, '', '', 0, 0, 0, '2020-01-30 17:42:34', '2020-01-30 17:42:34'),
	(179, 14, 9, '君たちにはコロシアイをしてもらいます！(大山おぶよ)', 0, '', '', 0, 0, 0, '2020-01-30 17:42:38', '2020-01-30 17:42:38'),
	(180, 14, 2, '最初からドタキャンするつもりだったんだろ', 0, '', '', 0, 0, 0, '2020-01-30 17:42:44', '2020-01-30 17:42:44'),
	(181, 14, 5, 'ちなみに金目当ての馬鹿は知らないだろうけど\r\n既に金持ちの男と結婚してもそれまでの資産は分配されないからな\r\n前澤の場合結婚してから稼いだ分は会社に入れて手元に残さないだろうから\r\n財産分与と養育費目当てで離婚しても入ってくるのは雀の涙になるわけ', 0, '', '', 0, 0, 0, '2020-01-30 17:42:51', '2020-01-30 17:42:51'),
	(182, 14, 8, 'ちなみに金目当ての馬鹿は知らないだろうけど\r\n既に金持ちの男と結婚してもそれまでの資産は分配されないからな\r\n前澤の場合結婚してから稼いだ分は会社に入れて手元に残さないだろうから\r\n財産分与と養育費目当てで離婚しても入ってくるのは雀の涙になるわけ', 0, '', '', 0, 0, 0, '2020-01-30 17:42:51', '2020-01-30 17:42:51'),
	(183, 14, 3, 'ゲスにゲスが釣られただけで、誰も損してない優しい世界', 0, '', '', 0, 0, 0, '2020-01-30 17:42:55', '2020-01-30 17:42:55'),
	(184, 14, 5, '前澤版バチェラーだもんなこれ', 0, '', '', 0, 0, 0, '2020-01-30 17:42:59', '2020-01-30 17:42:59'),
	(185, 14, 10, 'この人自分でも今虚しいとか寂しい的なこと言ってたしね\r\n金だけあれば殆どのことは出来るけど\r\n金だけじゃ出来ないこと本当に好かれないことは誰より理解してそう。', 0, '', '', 0, 0, 0, '2020-01-30 17:43:04', '2020-01-30 17:43:04'),
	(186, 14, 1, '純粋にお金目的と割り切れる人とお金に困って自らを身売りせざるを得ない人しか来ないのは最初からわかりきってたことだよなぁ\r\nそんなに自分に人としての魅力があるとでも思ってたのかな', 0, '', '', 0, 0, 0, '2020-01-30 17:43:08', '2020-01-30 17:43:08'),
	(187, 14, 7, 'ぶっちゃけバカが何人群がるか数字が見たかっただけやろw', 0, '', '', 0, 0, 0, '2020-01-30 17:43:13', '2020-01-30 17:43:13'),
	(188, 14, 9, 'テキトーに生きててもワンチャンある女さんが羨ましいです', 0, '', '', 0, 0, 0, '2020-01-30 17:43:17', '2020-01-30 17:43:17'),
	(189, 14, 9, 'やるって言ったんならやれ、ピエロなんだから楽しませてくれや', 0, '', '', 0, 0, 0, '2020-01-30 17:43:21', '2020-01-30 17:43:21'),
	(190, 14, 5, '自分ではほとんど金も使わずに名前売ってくれるんだもん、前澤にとっちゃいい宣伝になったよなあ\r\n話題になってくれりゃそれだけで金を作ることくらいできるんだろうし。', 0, '', '', 0, 0, 0, '2020-01-30 17:43:25', '2020-01-30 17:43:25'),
	(191, 14, 8, '万が一選ばれても、婚前財産はノータッチでしょ', 0, '', '', 0, 0, 0, '2020-01-30 17:43:30', '2020-01-30 17:43:30'),
	(192, 14, 4, 'お見合い企画があった事自体知らなかったけど、金持ちだったらこんなクズでもいいの？', 0, '', '', 0, 0, 0, '2020-01-30 17:43:35', '2020-01-30 17:43:35'),
	(193, 14, 3, 'そこに愛はない', 0, '', '', 0, 0, 0, '2020-01-30 17:43:40', '2020-01-30 17:43:40'),
	(194, 14, 7, '募集してることも知らなかったけど、何の条件付けもしなかったの？\r\nただの思いつきザル企画でやったならアホだなぁとしか。', 0, '', '', 0, 0, 0, '2020-01-30 17:43:47', '2020-01-30 17:43:47'),
	(195, 15, 2, 'イイハナシダナー', 0, '', '', 0, 0, 0, '2020-01-30 17:50:52', '2020-01-30 17:50:52'),
	(196, 15, 7, '良い話でよかったけど、どの辺が凄く衝撃的だったのかな', 0, '', '', 0, 0, 0, '2020-01-30 17:51:06', '2020-01-30 17:51:06'),
	(197, 15, 6, '夫同僚みたいに大きなリアクションで食べる人が周りに居なかったのなら衝撃受けても不思議ではないだろ\r\n同僚の影響で家族が食事の感想を言うようになったのも衝撃ポイントだと思うよ\r\n\r\nうちの嫁さんも結構リアクション大きくて美味しい美味しい言いながら食べるからその影響受けるって言うのはわかるけどな', 0, '', '', 0, 0, 0, '2020-01-30 17:51:13', '2020-01-30 17:51:13'),
	(198, 15, 6, 'オーストラリアは反日で有名だがまだまだ捨てたもんじゃないな', 0, '', '', 0, 0, 0, '2020-01-30 17:51:22', '2020-01-30 17:51:22'),
	(199, 15, 3, 'そんな風に影響される事もあるのか、ケッ。', 0, '', '', 0, 0, 0, '2020-01-30 17:51:26', '2020-01-30 17:51:26'),
	(200, 15, 5, 'ンマーイ!', 0, '', '', 0, 0, 0, '2020-01-30 17:51:30', '2020-01-30 17:51:30'),
	(201, 15, 6, 'そーめんよりそばが好き', 0, '', '', 0, 0, 0, '2020-01-30 17:51:34', '2020-01-30 17:51:34'),
	(202, 15, 1, '外人に絶賛される系の嘘松の典型例', 0, '', '', 0, 0, 0, '2020-01-30 17:51:43', '2020-01-30 17:51:43'),
	(203, 15, 7, '多分家族が同じリアクションしてきたら何のイヤミだってキレるだろ', 0, '', '', 0, 0, 0, '2020-01-30 17:51:53', '2020-01-30 17:51:53'),
	(204, 15, 8, '人間こうでありたい', 0, '', '', 0, 0, 0, '2020-01-30 17:52:17', '2020-01-30 17:52:17'),
	(205, 15, 4, '悔しかったら韓国冷麺とかで対抗してみーやw', 0, '', '', 0, 0, 0, '2020-01-30 17:52:22', '2020-01-30 17:52:22'),
	(206, 15, 8, 'オーストラリア人は全員反日と思ってるのか？', 0, '', '', 0, 0, 0, '2020-01-30 17:52:27', '2020-01-30 17:52:27'),
	(207, 15, 7, '以下、他人のふんどしで日本ホルホル', 0, '', '', 0, 0, 0, '2020-01-30 17:52:31', '2020-01-30 17:52:31'),
	(208, 15, 4, 'という夢をソーメンの山のなかで見た', 0, '', '', 0, 0, 0, '2020-01-30 17:52:35', '2020-01-30 17:52:35'),
	(209, 15, 3, 'いいね！', 0, '', '', 0, 0, 0, '2020-01-30 17:52:54', '2020-01-30 17:52:54'),
	(210, 15, 2, 'なんで卑屈な奴がおるん？', 0, '', '', 0, 0, 0, '2020-01-30 17:53:00', '2020-01-30 17:53:00'),
	(211, 15, 6, 'そうめんなんか麺つゆ飲む為の手段じゃん', 0, '', '', 0, 0, 0, '2020-01-30 17:53:04', '2020-01-30 17:53:04'),
	(212, 15, 1, '日本人は抑制を美徳とするからなあ。悪いことばかりじゃないけど、鬱々としてしまうのはそのせいもある。仕事がどうとか無関係に、男性の方が自殺が多いのってそれも要因だと思う。\r\nもっと気持ちに正直に、特にポジティブなのはガンガン出すべき。いつも心に葉っぱ隊を。', 0, '', '', 0, 0, 0, '2020-01-30 17:53:29', '2020-01-30 17:53:29'),
	(213, 15, 7, 'ええね。\r\n習慣ってことやね', 0, '', '', 0, 0, 0, '2020-01-30 17:53:40', '2020-01-30 17:53:40'),
	(214, 15, 3, 'メシウマ妻と結婚できて、ずっと幸せ感じてる。他のことも合わせて、頭上がらないぐらい感謝してる', 0, '', '', 0, 0, 0, '2020-01-30 17:53:52', '2020-01-30 17:53:52'),
	(215, 15, 1, '分かる、一昔前に流行った外国人に日本をマンセーさせるやつ。', 0, '', '', 0, 0, 0, '2020-01-30 17:54:06', '2020-01-30 17:54:06'),
	(216, 15, 10, '張り合いがないとか言ってるけど、旦那の影響の受けやすさを考えるとレス本人も対して人のこと褒めてねーってことにならんかコレ', 0, '', '', 0, 0, 0, '2020-01-30 17:54:14', '2020-01-30 17:54:14'),
	(217, 15, 4, 'これだからネットで真実さんは、、、行けばわかるがオージーの大多数は超親日やぞ、小学校第二外国語の授業が日本語の国が反日な訳ねーだろ、ただし総人口の4割が出稼ぎや移民で日本を除く特アで染まってるからこの辺が声デカくはある', 0, '', '', 0, 0, 0, '2020-01-30 17:54:34', '2020-01-30 17:54:34'),
	(218, 15, 5, '「愛してる」って言葉に出して言わない国民性だもんなそういや\r\nこれもちゃんと普段から声に出して伝えてるかどうかで相当変わるものらしいからな', 0, '', '', 0, 0, 0, '2020-01-30 17:54:39', '2020-01-30 17:54:39'),
	(219, 15, 3, '料理が美味しくなる魔法', 0, '', '', 0, 0, 0, '2020-01-30 17:54:43', '2020-01-30 17:54:43'),
	(220, 15, 10, '最後みたいに第三者が質問に答えるのってウザいよね\r\nおまえの見解なんか聞いてねーよってね', 0, '', '', 0, 0, 0, '2020-01-30 17:54:55', '2020-01-30 17:54:55'),
	(221, 15, 6, 'フリーソーメン所属', 0, '', '', 0, 0, 0, '2020-01-30 17:55:00', '2020-01-30 17:55:00'),
	(222, 15, 2, '嘘っぽいって思っちゃうけど、ひねくれすぎてるなのかな\r\nまあ嘘でもいちいち口に出すのは野暮なのかもね', 0, '', '', 0, 0, 0, '2020-01-30 17:55:06', '2020-01-30 17:55:06'),
	(223, 15, 9, '誉め言葉はガンガン言っても言いと思うよ\r\n嫌味に聞こえるのはわざとらしいか受け取り手が捻くれてるかだよ\r\n美味いと言うと喜ばれるよ', 0, '', '', 0, 0, 0, '2020-01-30 17:55:12', '2020-01-30 17:55:12');

INSERT INTO `room` (`room_id`, `category_id`, `user_id`, `title`, `body`, `room_text1`, `room_text2`, `room_flag1`, `room_flag2`, `delete_flag`, `created_date`, `updated_date`) VALUES
	(1, 1, 1, 'エンジニアになりたい人の部屋', 'エンジニアになりたい人で喋ろうぜ。\r\nこれからはエンジニアの時代だ。', '', '', 0, 0, 0, '2020-01-25 17:00:09', '2020-01-25 17:00:09'),
	(2, 3, 2, '楽して稼ぎたい人集まれ', '先着10名限定！\r\n誰でも簡単に10分で1万円稼げる方法を教えます。\r\n早いもの勝ちなので、急いでください。', '', '', 0, 0, 0, '2020-01-25 17:18:56', '2020-01-25 17:18:56'),
	(3, 2, 3, 'ポケモンランキング一位を目指す', '私はコダック。\r\nポケモンランキングで一位を取るためには、どうしたらいいか考察してみました。\r\n\r\n【目標】\r\n・好きなポケモンランキングで一位を取る。\r\n・二位以下はゴミ。\r\n\r\n私がやるべきことは、なんだろう\r\n\r\n・頭を抱えて、あざとさUP\r\n\r\nとりあえず頭を抱えておけばそれなりに可愛い感じになるのではないか。\r\n\r\n・黒目を大きくしたい\r\n\r\n黒目を大きくすることでより童顔になる。きがする。\r\n\r\n。色違いになる\r\n\r\nあのピカチュウとやらが色をかぶせてきている。これは色違いになるしかない。進化するか？\r\n\r\nコレ以外になにか思いつく人いたら教えて下さい。\r\n\r\n', '', '', 0, 0, 0, '2020-01-25 17:18:56', '2020-01-25 17:18:56'),
	(4, 4, 4, 'ディズニーランドを倒したい', 'この前、関東の人に「ユニバww」ってバカにされました。\r\n大阪人として、ユニバがディズニーに負けている現実が許せません。\r\nユニバがディズニーに圧勝する方法誰か思いつく人いませんか。', '', '', 0, 0, 0, '2020-01-27 13:20:56', '2020-01-27 13:20:56'),
	(5, 1, 1, '就職活動について情報共有', '就活中の人同士で、情報共有しましょう。', '', '', 0, 0, 0, '2020-01-27 13:25:43', '2020-01-27 13:25:43'),
	(6, 2, 2, '京都でバンド組みたい人募集', 'いま、京都市内でバンドやりたい人を募集しています。\r\n楽器経験者のほうがいいです。\r\nパートは、カスタネット、タンバリン、鍵盤ハーモニカ、リコーダーの枠が余っています。', '', '', 0, 0, 0, '2020-01-27 14:15:31', '2020-01-27 14:15:31'),
	(7, 3, 4, '大阪で何かしらイベントを開きたい', '大阪で1000人規模のイベントやりたいんですが、こんなことやりたいって案ありますか？\r\n\r\n特にジャンルは指定しません。', '', '', 0, 0, 1, '2020-01-27 14:23:32', '2020-01-27 14:23:32'),
	(8, 10, 1, '【画像】 中国の封鎖が雑すぎると話題に', '<img src="https://livedoor.blogimg.jp/dqnplus/imgs/7/f/7f9e7c4e.jpg" width="500px">', '', '', 0, 0, 0, '2020-01-27 18:29:12', '2020-01-27 18:29:12'),
	(9, 10, 5, 'いきなりステーキ、閉店するする詐欺で炎上wwwwwww', '何故か閉店日を過ぎても営業を続ける店舗が各地で続出', '', '', 0, 0, 0, '2020-01-27 18:39:51', '2020-01-27 18:39:51'),
	(10, 1, 6, 'サンドイッチ界最強はカツサンド', '底辺弱者はたまごサンドでも食ってな', '', '', 0, 0, 0, '2020-01-27 18:44:41', '2020-01-27 18:44:41'),
	(11, 8, 7, '焼酎は何で割ったら美味しいか教えてくれ', 'お勧めがあったら教えてくれ', '', '', 0, 0, 0, '2020-01-27 18:47:18', '2020-01-27 18:47:18'),
	(12, 1, 8, '【これマジ？】子どものゲーム、親の8割以上がまさかの・・・', '1日のプレイ時間として、適切と思われる時間を聞くと、平均で「1.183時間」だった。回答者の内訳は「1時間」（47.6％）が最多。次いで「2時間」（15.7％）、「30分以下」（12.7％）、「1.5時間」（11.4％）と続き、わずかながら「2時間以上」（4.2％）と答える人もいた。\r\nhttps://news.careerconnection.jp/?p=86557\r\n子供のゲーム時間は規制すべきと思いますか？するとしたら1日の時間はどれくらいがいいと思いますか？', '', '', 0, 0, 0, '2020-01-28 11:24:28', '2020-01-28 11:24:28'),
	(13, 3, 9, '【朗報】今ならメルカリでマスクを売るだけで大金持ちになれるぞwwwwww', 'マスクが1000万円で出品されてしまう…orz\r\n<img src="https://i.imgur.com/7kWNfw3l.jpg"/>', '', '', 0, 0, 0, '2020-01-30 17:32:53', '2020-01-30 17:32:53'),
	(14, 7, 3, '大富豪・前澤友作のお見合い企画に2万7722人の女性が殺到した結果wwwwwwwwwwww', '前澤友作氏、2万7722人殺到のお見合い企画中止を発表「自分の気持ちを整理することができませんでした」\r\n\r\n　ファッション通販サイト「ZOZO」創業者で、スタートトゥデイ社長の前澤友作氏（44）が30日、自身のツイッターを更新し、インターネットテレビ局「Abema　TV」で予定していた自身のお見合い企画を中止することを発表した。\r\n\r\n　前澤氏は「この度、私の個人的な事由により、Abema　TVさんの『FULL　MOON　LOVERS』への出演ならびに放送を中止していただく旨、Abema　TVさんに申し出ました」と報告。「真剣に出演させていただくことを決めたものの、どうしても最後まで自分の気持ちを整理することができませんでした」と明かした。\r\n\r\n　続けて「27，722人もの方が真剣に考え、時間を割き、ご応募してくださったことを思うと、本当に申し訳ない気持ちでいっぱいです。ただ、この中途半端な気持ちのまま番組に臨むことは、参加してくださる皆さまに大変失礼であると考え、身勝手ではありますが、中止のお願いをさせていただきました」と説明。', '', '', 0, 0, 0, '2020-01-30 17:40:27', '2020-01-30 17:40:27'),
	(15, 2, 1, '素麺が大好きなオーストラリア系白人の夫同僚', 'お中元のソーメンがめちゃくちゃ余ってしまった年、オーストラリア系白人の夫同僚がソーメン大好きだというから\r\nしょっちゅう家に呼んで食べてもらってた。\r\nうちは息子二人+私達夫婦の四人家族で、何を出しても誰もうまいともまずいとも言わない、でも毎回完食、みたいな感じだった。\r\n全員好き嫌いないし大食いだしなんだけど、「これおいしい、また作って」「あれが食べたい」程度すら言わない。\r\n文句なく完食してくれるのはありがたいけど、ちょっと張り合いないなーとは思ってた。\r\nしかし夫同僚は真逆だった。何に対してもすばらしくリアクションがよかった。\r\nただのソーメン+めんつゆで出すと「ウマーイ！」完食。\r\nサラダソーメン風にすると「ウマすぎる！キミ料理の天才じゃない？」完食。\r\nビーフンみたいに炒めてピリ辛にすると「永遠に食べていたい！」完食。\r\nジャージャー麺っぽくすると「今この瞬間に死んでもいい！」完食。\r\n面白いことにつられて夫や息子たちのリアクションまで良くなっていった。\r\n最初は夫同僚のボキャブラリーに対抗みたいなギャグっぽい感じで\r\n「ウマーイ！」「俺はもっとウマーイ！」「アメージング！」「イエーー！！」みたいな感じだったけど\r\n段々自然になっていって、夫同僚がいない時でも「これうまい」「うまいな」「もっと辛くてもいける」とか言うようになった。\r\nあと夫がごく自然に、夫同僚に私のノロケを言うようになった。\r\nこれも夫同僚の影響。夫同僚がめちゃくちゃ恋人（日本人）のことをノロケるから。\r\nなので私も夫や息子のことをノロケ返した。\r\nむちゃくちゃ家の中の空気がよくなって、やっぱり言葉に出すのって大事なんだと思ったわ。\r\n夫同僚は帰国しちゃったけど「うまい」って言い合う習慣は今も残ってるし夫婦円満だ。', '', '', 0, 0, 0, '2020-01-30 17:50:04', '2020-01-30 17:50:04');

INSERT INTO `user` (`user_id`, `name`, `password`, `address`, `user_text1`, `user_text2`, `user_flag1`, `user_flag2`, `delete_flag`, `created_date`, `updated_date`) VALUES
	(1, '山田　一郎', 'password', 'yamada@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(2, '田中　二郎', 'password', 'tanaka@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(3, '佐藤　三郎', 'password', 'satou@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(4, '高橋　四郎', 'password', 'takahashi@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(5, '井筒　将之', 'password', 'idutsu@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(6, '原田　翔平', 'password', 'harada@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(7, '山根　瑞葵', 'password', 'yamane@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(8, '吉村　八郎', 'password', 'yoshimura@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(9, '上村　九郎', 'password', 'uemura@mail.co.jp', '', '', 0, 0, 1, '2020-01-23 20:03:12', '2020-01-23 20:03:12'),
	(10, '市川　十郎', 'password', 'ichikawa@mail.co.jp', '', '', 0, 0, 0, '2020-01-23 20:03:12', '2020-01-23 20:03:12');
