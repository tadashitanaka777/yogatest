<?php include( dirname(__FILE__) . '/function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form>
        <div class="page-title">
            <div class="title_left">
                <h1>マイページ <small>My Page</small></h1>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>通知 <small>Notifications</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled ul-msg">
                            <li class="li-msg">
                                <div class="msg-thumbnail">
                                    <span class="image">
                                        <img src="images/thumbnail-500x500.jpg" alt="img">
                                    </span>
                                </div>
                                <div class="msg-content">
                                    <div class="msg-right">
                                        <span class="time">3 mins ago</span>
                                        <select class="form-control msg-select">
                                        <?php foreach($dataClass->getValues(2) as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-primary">決定</button>
                                    </div>
                                    <span class="msg-title">オハナスマイルヨガスタジオ 祐天寺店より</span>
                                    <span class="message">承認申請が届きました</span>
                                </div>
                            </li>
                            <li class="li-msg">
                                <div class="msg-thumbnail">
                                    <span class="image">
                                        <img src="images/thumbnail-500x500.jpg" alt="img">
                                    </span>
                                </div>
                                <div class="msg-content">
                                    <div class="msg-right">
                                        <span class="time">3 mins ago</span>
                                        <select class="form-control msg-select">
                                        <?php foreach($dataClass->getValues(2) as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-primary">決定</button>
                                    </div>
                                    <span class="msg-title">西浦 莉紗様より</span>
                                    <span class="message">承認申請が届きました</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>お知らせ <small>Information</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                  <div class="x_content">
                    <ul class="list-unstyled timeline">
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="#" class="tag">
                                        <span>Information</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="#">コミュニティサイトへようこそ</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>yogageneration</a>
                                    </div>
                                    <p class="excerpt">コミュニティサイトではヨガに関わる様々な情報をユーザーが個人で発信することができます。また、顧客や業界関係者へのPRになりますので、どんどんPRしてください。 <a href="#">もっと読む</a></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span>Information</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="#">ヨガジェネレーションのメディアサイトをリニューアルしました</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>yogageneration</a>
                                    </div>
                                    <p class="excerpt">ヨガ業界の最新情報をお届けします。 <a href="#">もっと読む</a></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="#" class="tag">
                                        <span>Information</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="#">コミュニティサイトへようこそ</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>yogageneration</a>
                                    </div>
                                    <p class="excerpt">コミュニティサイトではヨガに関わる様々な情報をユーザーが個人で発信することができます。また、顧客や業界関係者へのPRになりますので、どんどんPRしてください。 <a href="#">もっと読む</a></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span>Information</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="#">ヨガジェネレーションのメディアサイトをリニューアルしました</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>yogageneration</a>
                                    </div>
                                    <p class="excerpt">ヨガ業界の最新情報をお届けします。 <a href="#">もっと読む</a></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="#" class="tag">
                                        <span>Information</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a href="#">コミュニティサイトへようこそ</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>yogageneration</a>
                                    </div>
                                    <p class="excerpt">コミュニティサイトではヨガに関わる様々な情報をユーザーが個人で発信することができます。また、顧客や業界関係者へのPRになりますので、どんどんPRしてください。 <a href="#">もっと読む</a></p>
                                </div>
                            </div>
                        </li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php include ( WORKSPACE . '/include/footer.php' ); ?>