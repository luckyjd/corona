@extends('layouts.frontend.layouts.main')
@section('content')

    <section class="policy-term">
        <div class="header" style="height: 220px; background: #0d2344;">
            <p class="noto-sans-cjk-ip-bold title-product__privacy">利用規約</p>
        </div>
        <div class="container p-0">

            <div class="policy-term noto-sans-cjk-ip-medium wow fadeIn p-3"  data-wow-duration="3s">
                <br><br>
                <p>最終更新日：2018年4月26日<br>
                    アンハイザー・ブッシュ・インベブ ジャパン株式会社（その関係会社を含み以下、「当社」といいます）が所有し運営するウェブサイト、http://corona-extra.jp/ （以下、「当ウェブサイト」といいます）にお越しいただきありがとうございます。
                </p>
                <br><br>

                <h3>適用</h3>
                <p>以下の利用規約（以下、「本規約」といいます）は，ユーザーと当社との間の当ウェブサイトの利用に関わる一切の関係に適用されるものとします。ユーザーの当ウェブサイトの利用と当ウェブサイトへのアクセスは、本規約に準拠し、それに従うものとします。本規約に同意しない、または ここ をクリックすることで閲覧でき、ここで言及することにより本規約に組み込まれる「<a class="privacy" href="{{route('privacypolicy')}}/">プライバシーポリシー</a>」に同意しない場合は、当ウェブサイト、または当ウェブサイトが提供するサービスを利用しないでください。当ウェブサイトに参加、アクセス、閲覧、情報を提供する、または別の方法で当ウェブサイトを利用することによって、ユーザーは以下の規約に同意すること、および本人が20歳以上であることを表明し保証するものとします。本規約に同意しない、または本人が20歳未満である場合は本サイトのご利用をお控えください。
                </p>
                <br><br>

                <h3>電子コミュニケーション</h3>
                <p>本サイトにアクセス、利用、参加、閲覧、情報を提供する、または他の方法で当ウェブサイトを利用することにより、ユーザーは、当社から電子形式のコミュニケーションを受領することに同意するものとします。当社は、電子メール、テキスト、アプリ内のプッシュ通知によって、または本サイト上への通知やメッセージの掲載など、さまざまな方法でユーザーとコミュニケーションすることができます。当社がユーザーに電子形式で提供するすべての同意、通知、開示またはその他のコミュニケーションは、それらが書面で送付するよう求められた場合の法的要件を満たしていることにユーザーは同意するものとします。</p>
                <br><br>
                <h3>知的財産権の所有権</h3>
                <p>別途示されない限り、当ウェブサイト上のすべてのテキスト、コンテンツおよび文書、当ウェブサイトに掲載される名称、ロゴ、商標、サービスマーク、ブランドアイデンティティ、キャラクター、商号、グラフィクス、デザイン、著作権、トレードドレス、または他の知的財産ならびに当ウェブサイト上の組織、編集、外観と雰囲気、イラスト、図柄、映像、音楽、ソフトウェアおよびその他の作品（以下、「当コンテンツ」といいます）は、当社（もしくはその関係会社）または第三者（以下、「本所有者」といいます）が所有しており、著作権、商標およびその他の知的財産・所有権に関する法律のもとで保護されています。当社 とユーザーの間における当コンテンツに関するすべての権利、権原および利益は、常に当社 もしくは本所有者、またはその両方に帰属します。当ウェブサイト上で使用されるすべてのブランド名、製品名、タイトル、スローガン、ロゴまたはサービス名、およびその他のマークは、 当社 または本所有者の登録済みもしくはコモンロー上の、またはその両方の商号、商標またはサービスマークです。<br><br>

                    錯誤を避けるために詳述すれば、当社、ならびに当ウェブサイトに含まれるまたは当ウェブサイトを通して利用可能となる関連の画像、ロゴ、ページヘッダー、ボタンアイコン、スクリプトおよびサービス名は、日本およびその他の国々における当社の商標、登録商標またはトレードドレスです。当社の商標およびトレードドレスを、欺くように類似させ顧客に混乱を引き起こしかねない、または当社を希薄化、中傷、非難したり、もしくはその信用を落としたりするやり方で、 当社が所有しない製品またはサービスに関連させて使用することはできません。ユーザーは、当社から事前に書面の同意を得ることなく、ハイパーリンクの一部として当社 のロゴまたはその他の専有画像もしくは専有商標を使用することを禁じられています。当ウェブサイトに掲載されるが当社が所有していない他のすべての商標および関連の画像、ロゴ、スクリプト、サービス名、トレードドレスは、当社と提携、関連、または当社から出資を受けているか否かに関わらず、個々の本所有者の所有物です。
                </p>
                <br><br>
                <h3>利用制限、利用上の制約</h3>
                <p>ユーザーは、本規約にて定める合法的な目的のためにのみ、当コンテンツや当ウェブサイト上のサービスおよび製品を利用することを許可され、当コンテンツのその他の利用または悪用を固く禁じられています。当社 はユーザーに、次の条件に基づきサブライセンスの権利なしで、当コンテンツにアクセスし利用するための非独占的、制限付き、個人向け、譲渡不能、取消可能なライセンスを与えます。ユーザーは、当社 の明示的な書面同意を得ることなく、(a) 当コンテンツを複製、再送信、修正、流布、表示、上演、再利用、再投稿、放送、配布もしくは他の方法で配信したり、または当コンテンツの全部もしくは一部を修正もしくは再利用しないものとします。(b) メタタグやキーワード、隠しテキストに当社の商号、 商標またはブランド名を使用しないものとします。(c) いかなる方法であれ、全体もしくは一部にかかわらず、当コンテンツから派生物を創作せず、または当コンテンツを営利目的で活用しないものとします。(d) 当ウェブサイト上の当コンテンツを含む何らかのデータを収集または抽出するために、データマイニングツールを使用しないものとします。また、(e) 当社、本所有者、または当ウェブサイトや当コンテンツにて言及される第三者に関して誤ったもしくは誤解を招く印象、特性または意見を導く可能性のあるやり方で、当ウェブサイトや当コンテンツ、またはその一部を利用しないものとします。 当社 は、その他すべての明示的および黙示的な権利を留保します。ユーザーは、当コンテンツに含まれる著作権表示、電子透かし、所有レジェンドまたはその他の表示を変更、削除、または覆い隠してはなりません。 本規約にて明示的に定める場合を除き、禁反言、暗示またはその他によるかを問わず、当ウェブサイト上のいかなる内容も、当社や本所有者の知的財産権に基づくライセンスの付与とは解釈されないものとします。本規約にこれと異なる定めがあるとしても、当社 は、事前の通知を与えることなくいつでも、ユーザーのIPアドレスをブロックすることを含め、前述の権利やユーザーの当ウェブサイトへのアクセス権、またはその一部を取り消すことができます。<br><br>
                    本規約により付与される制限付きライセンスは、ユーザーが本規約のいずれかに違反した日付、または当社 が本サイトのサービスを終了した日付をもって終了します。当社 は、ユーザーが本規約に違反したことを当社が合理的に判断する場合を含め、いかなる時にもいかなる理由であれ、ユーザーのユーザーアカウントを中止または終了させることができます。当社は、その単独の裁量にて、ユーザーアカウントに関連する電子メールアドレスを用いて、またはユーザーが次にユーザーアカウントにアクセスを試みたときに、当該の中止または終了についてユーザーに通知するよう合理的な努力を尽くします。終了に伴い、ユーザーは、本サイトにて 当社 が提供するサービスの利用を完全に止めなければなりません。本ライセンスの終了によって、 当社 がコモンロー上または衡平法上得られるその他の権利または救済が制限されることはありません。
                </p>
                <br><br>
                <h3>ソーシャルメディアサイトと第三者のリンク</h3>
                <p>当ウェブサイトには適宜に、さまざまなソーシャルメディア・ウェブサイト（以下、「ソーシャルメディアサイト」といいます）など、当社の支配の及ばない他のサイト（以下、「リンクサイト」といいます）との交流をユーザーに可能にする特性や機能が含まれます。 当社 は、そのような特性、機能およびリンクを便宜上の目的に限って提供しており、リンクサイトまたはソーシャルメディアサイトを是認しているわけではありません。 当社 は、リンクサイトやソーシャルメディアサイトのコンテンツや送信、またはリンクサイトやソーシャルメディアサイトの利用規約やプライバシー慣行に対して責任を負いません。ユーザーは、自身が閲覧するサイトのポリシーを注意深く読むべきです。また、ソーシャルメディアサイトを利用して 当社またはその製品のいずれかについてコメントする場合、ユーザーは、 当社との重要な関連性、または自身のコメントに関連して当社から受け取る対価について常に明確にはっきりと分かるように開示することに同意します。 いかなる状況であれ、ユーザーは、当社との重要な関連性または対価の受領の有無を問わず、ソーシャルメディアサイト上で、当社 またはその製品のいずれかに関して申立てを行うことを許可されません。前述の規定に違反して、ユーザーがソーシャルメディアサイト上で当社または当社の製品のいずれかに関して申立てを行った場合、当社ではなくその申立人が当該申立ての唯一の作成者となり、よって、単独でその責任を負うものとします。
                </p>

                <br><br>
                <h3>ユーザーの投稿</h3>
                <p>コンテンツを投稿するまたは素材を提供する場合、当社が別途指示しない限り、ユーザーは、あらゆるメディアにて世界中で当該のコンテンツを使用、再現、修正、改作、公開、上演、翻訳、配信、表示する、またその派生物を創作する非独占的、著作権使用料無料、恒久的、取消不能、完全にサブライセンス可能な権利を当社に与えます。ユーザーは、当社およびサブライセンシーがその使用を選択する場合には、当該コンテンツに関連してユーザーが提供する名称を使用する権利を当社およびサブライセンシーに与えます。ユーザーが投稿したアイデアや提案における現在既知または今後存在するすべての権利を、制限なく、 当社 は独占的に所有し、ユーザーは取消不能のかたちで当社に移転および譲渡します。また、当社 は、営利目的またはその他のいかなる目的であれ、ユーザーにいかなる形態の報酬も与えることなく、当該のアイデアや提案を無制限で利用する権利を有するものとします。
                </p>
                <br><br>
                <h3>コミュニティに関するガイドライン</h3>
                <p>ソーシャルメディアサイトへのリンクに加え、当ウェブサイト自体に、投稿またはリアルタイムでの交流によって、情報の投稿、フィードバックやコメントの提供、その他の方法による他のユーザーと交流をユーザーに可能にする掲示板やブログ、チャットルーム、コメントセクション、その他のコミュニティフォーラム（ソーシャルメディアサイトの 当社 関連セクションと共に以下、「コミュニティフォーラム」といいます）が含まれる場合があります。 <br><br>

                    当ウェブサイトにコミュニティフォーラムが含まれる場合、本セクションにて示す制約と義務が適用されるものとします。<br><br>

                    • ユーザーは、投稿するコンテンツに対するすべての権利を所有または他の方法で管理していること、当該コンテンツは正確であること、提供するコンテンツの利用は本規約に違反しておらず、いかなる個人または事業体も権利侵害していないこと、また、提供したコンテンツから生じるすべての申立てについて当社を補償することを表明および保証します。<br>
                    • ユーザーは、当社 が、コミュニティフォーラムにて閲覧可能な情報を編集もしくは修正する義務を負わず、または投稿者同士の紛争もしくは論争を解決したりしないこと、また、コミュニティフォーラムに投稿されたコンテンツについてユーザーに対して責任を負わないことを認めます。<br>
                    • ユーザーは、コミュニティフォーラムにて提示または流布される意見、発言、推薦、オファー、助言またはその他の情報が、自身のコンテンツに対して単独で責任を負う個々の作成者のものであることを認めます。当社 は、その単独の裁量にて、コミュニティフォーラムに提供または投稿される素材の投稿または削除を拒否する権利を留保します。<br>
                    • 本サイトを利用することによりユーザーは、(a) ユーザーが投稿したコメント、画像またはその他のコンテンツ（以下、「本投稿」といいます）を、ユーザーの単独の指示により、当社のサーバーとシステム上に保管するよう（適切な場合には）当社に指示し、また、(b) 性質上営利目的になり得るコンテンツに投稿を組み入れることを含め（但し、それには限定されません）いかなる目的であれ、本投稿を使用、修正または改作する無制限、恒久的、著作権使用料無料、サブライセンス可能、譲渡可能、取消不能のライセンスを当社 に与えます。さらに、本サイト上の情報は公開され、あらゆるユーザーがアクセス可能になるため、ユーザーは、自身の本投稿に関してプライバシーを期待しないことを認めます。ユーザーは、以下のいずれかに該当するいかなる投稿も明示的に禁じられています（以下、「禁じられた投稿」といいます）。<br>
                    • 飲酒運転もしくは無責任なアルコール摂取を促す、競合製品を誹謗する、または違法、名誉棄損、中傷、ひわい、ポルノ、わいせつ、みだら、人種差別、挑発、嫌がらせ、脅迫、プライバシー権やパブリシティ権の侵害、虐待、扇動、不正に値するもしくはその他好ましくない本投稿<br>
                    • 犯罪行為に相当する、それを奨励するもしくは指示する、特定の当事者の権利を侵害する、その他の方法で責任を生じさせる、国内法もしくは国際法に違反する本投稿。児童ポルノ、暴力行為、薬物使用について描写する、または証券取引所の規則に違反する素材を含みますが、それには限定されません。<br>
                    • 特定の当事者の特許、商標、企業秘密、著作権、パブリシティ権またはその他の知的財産権を侵害する可能性のある本投稿<br>
                    • 特定の個人もしくは事業体になりすます、または個人もしくは事業体との協力関係を偽って伝える本投稿<br>
                    • 未承諾宣伝、政治的な運動、広告または勧誘<br>
                    • 第三者の個人情報。住所、電話番号、電子メールアドレス、マイナンバー、クレジットカード番号を含みますが、それには限定されません。<br>
                    • ウィルス、スパイウェア、トロイの木馬、破損データまたはその他の有害もしくは破壊的なファイル<br>
                    • 違法、ひわい、脅迫、中傷、プライバシーの侵害に値する、その他第三者に対して有害なもしくは好ましくない本投稿、または政治運動、営利目的の勧誘、チェーンレター、大量メール送信、あらゆる形態の「スパム」もしくは営利目的の未承諾電子メッセージ<br>
                    • 当社の単独の裁量にて不適切もしくは好ましくないとされる、他者の当ウェブサイトの利用や享受を制限もしくは阻害する、または当社 またはその関係会社やユーザーを何らかの損害もしくは負担にさらす可能性のある本投稿

                </p>

                <br><br>
                <h3>アプリの許可</h3>
                <p>当社 が作成、所有またはライセンスするアプリを利用するとき、ユーザーは、自身の機器を通じて当社に特定の許可を与えている場合があります。ほとんどのモバイル機器は、こうした許可に関する情報をユーザーに伝えています。</p>
                <br><br>

                <h3>非アーカイブ</h3>
                <p>たとえ当ウェブサイトが、当社のサーバーまたはシステムに特定の本投稿をアップロードすることをユーザーに許可する特性や機能を備えていても、当ウェブサイトはアーカイブではなく、アーカイブとして機能するわけではありません。 当社 はユーザーまたはその他の者に対して、ユーザーの本投稿が損失、損害または破損された場合も一切責任を負わないものとします。ユーザーは、本投稿の独自のアーカイブおよび バックアップコピーの維持について単独で責任を負うものとします。</p>

                <br><br>
                <h3>海外へのデータ転送</h3>
                <p>当ウェブサイトを利用することにより、ユーザーは、当ウェブサイトが日本と米国にてホストされていることに同意し確認します。日本国法とは異なる個人情報の利用や開示に関する法律または規則を持つ欧州連合、米国またはその他の地域内の物理的場所から当ウェブサイトにアクセスを試みる場合、ユーザーは、日本国法、本規約および 当社 のプライバシーポリシーに準拠する当ウェブサイトを継続的に利用することによって、自身の個人情報が米国にも転送されること、ならびに、(a) 当該の転送、(b) プライバシーポリシーや当ウェブサイトの利用について生じる紛争に関する日本国法の適用、および(c) 日本国の裁判所の専属管轄権、に同意することになることをご承知おきください。</p>

                <br><br>
                <h3>紛争解決</h3>
                <p>本規約の準拠法は日本国法とし、全体もしくは一部を問わず、ユーザーによる当ウェブサイトの利用からまたはプライバシーポリシーに関連して生じるユーザーと当社間の申立てまたは紛争については、東京地方裁判所または東京簡易裁判所を第一審の専属的合意管轄裁判所とします。各当事者は、当該裁判所が当該当事者に関する対人管轄権を有することに同意し、また、各当事者は、当該裁判所の対人管轄権に服し、不便な法廷地で提起されたと抗弁する権利を放棄するものとします。</p>


                <h3>免責事項</h3>
                <p>前述を制限することなく、当ウェブサイトや当ウェブサイト上の他のすべての機能に含まれるまたはそれを通して利用可能になる、当コンテンツ、情報、素材、ソフトウェアを含む製品およびサービスは、明示的または黙示的を問わず、特定の目的に対する適合性、商品性、権原、権利侵害なきことについて（但し、それには限定されません）、当ウェブサイトや当コンテンツに関する一切の保証なしで「現状有姿」および「提供可能な限度」にてユーザーに提供されます。適用法が、前述の明示的または黙示的な保証の免責を認めない場合、当社 が、当該の適用法により要求される明示的または黙示的な最小限の保証を与えます。 当社 、その従業員、代理人、サプライヤーまたはその他の者からユーザーが得た助言または情報は、口頭または書面を問わず、本セクションにて明示的に示されていない保証や表明を意味するものではありません。当社 は、当ウェブサイトが途切れず安全で エラーがないこと、ユーザーの当ウェブサイトの利用がユーザーの期待を満たすこと、または当ウェブサイト、当コンテンツもしくはその一部が真正で正確かつ信頼できることについて一切保証していません。当社 は、いかなる時にも予告なく、どの部分であれ当ウェブサイトを変更する権利を留保します。当社 は、 当社のサービス、当ウェブサイトや当社 の電子コミュニケーションに含まれるまたはそれを通して利用可能になる情報、当コンテンツ、素材、ソフトウェアを含む製品またはサービスに、ウィルスまたはその他の有害な要素が混入していないことを保証しません。</p>

                <br><br>
                <h3>責任の制限</h3>
                <p>当ウェブサイトは自己責任で利用してください。当社、その関係会社、またはそれぞれの役員、取締役、代理人もしくはその他の代表者のいずれも、原因を問わず、また、契約の違反、不法行為（過失を含みます）、所有権の侵害、製造物責任もしくはその他に基づくか否かを問わず、当ウェブサイトへのアクセスやその利用、もしくは 当社 のサービスの利用から生じる、または、当ウェブサイト上で利用可能となる、もしくは 当社によって利用可能となる当コンテンツやその他の情報、素材、製品（ソフトウェアを含みます）、その他のサービスへの反応としてもしくはその結果として取られた行動から生じる、データや収入、利益、営業上の信用の損失、財産の損失や損傷、第三者の申立てを含む（但し、それには限定されません）直接的、間接的、付随的、結果的、特別もしくは懲罰的な損害に対して責任を負いません。前述の規定は、当社 が当該の損害発生の可能性について知らされていたとしても適用されるものとします。ユーザーが、当ウェブサイト、本規約またはプライバシーポリシーに何らかの点で満足できなくなった場合、ユーザーの唯一かつ排他的な救済は、当ウェブサイトとそのサービスの利用を止めることです。ユーザーは、ユーザーの当ウェブサイトの利用から生じる、当社とその関連会社、代理人、代表者およびライセンサーに対する一切の申立てを権利放棄するものとします。一部の管轄区域では、黙示的な保証の免責または特定の種類の損害の除外や制限が認められていないため、これらの規定がユーザーに適用されず、ユーザーが追加の権利を有する場合があります。この責任の制限のいずれかの部分が、何らかの理由で無効または強制不能であることが判明した場合、当社 とその関係会社の債務総額は1万円を超えないものとします。本規約にて示す責任の制限は、取引の基礎における基本的要素であり、公正なリスクの配分を反映しています。当ウェブサイトは、こうした制限なしでは提供されないものであり、ユーザーは、本規約にて特定される責任の制限と除外、免責、排他的救済 が、たとえその本質的目的を達成できないことが判明したとしても存続することに同意します。</p>

                <br><br>
                <h3>フレーム化、リンク、第三者サイトの禁止</h3>
                <p>当社から事前の書面承認を得ない限り、フレーム化、インラインリンク、または当ウェブサイトとのその他の関連付けは明示的に禁じられています。</p>

                <br><br>
                <h3>本規約を受諾する能力</h3>
                <p>ユーザーは20歳よりも年長であり、また、本規約にて定める規定、条件、義務、確約、表明および保証を締結し、本規約に従いこれを遵守することが十分に可能でその能力があることを確認します。</p>
                <br><br>
                <h3>告知</h3>
                <p> 当社は、適宜本規約を改正することが出来ます。ユーザーが最新の変更を把握できるよう、当社 は、本規約の最終更新日を本ページの最上部に記すか、または変更についての明確な告知を当ウェブサイトに掲載します。ユーザーが、改正された本規約の掲載後に当ウェブサイトを利用することにより、当該の改正規約に同意したものと見なされます。当社 は、本規約を定期的に確認されることを強くお勧めします。当社によるユーザーの個人情報の利用または開示に関する制限を大幅に緩和することになる本規約の改正を行う場合に限り、当社 は、かかる個人情報に関する当該改正を実施する前に、ユーザーの同意を得ることを商業上合理的な方法で試みます。ユーザーがいかなる時点かにおいて本規約の規定に同意しない場合は、ユーザーの唯一の救済は当ウェブサイトの利用を止めることです。当ウェブサイトを継続的に利用することは、ユーザーが、その時点で有効な本規約に同意しているものとみなされます。</p>
                <br><br>
                <h3>雑則</h3>
                <p>当社 が本規約のいずれかの規定を実施しない場合でも、当該の規定または当該の規定を行使する権利の放棄とは見なされないものとします。上記に定める保証の免責および責任の制限を含め（但し、それには限定されません）、本規約のいずれかの部分が適用法に基づき無効または強制不能と判断された場合、当該の無効または強制不能な規定は、当初の規定の意図に最も厳密に適合する有効かつ強制可能な規定に取って代わられ、本規約の残りの規定は有効に存続するものとします。本規約および電子形式で送られた通知の印刷版は、本来印刷形式にて作成および維持されるその他のビジネス文書や記録と同等の範囲および条件にて、本規約に基づくまたはそれに関する訴訟手続きまたは行政手続きにて認められるものとします。</p>
                <br><br>
                <h3>アルコール飲料の購入</h3>
                <p>20歳以上でない限り、合法的にアルコール飲料を注文することはできません。また、20歳未満の者のためにアルコール飲料を購入することはできません。</p>

            </div>
        </div>
    </section>
   @stop
