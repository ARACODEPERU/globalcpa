<div>
    <section id="team-visionaries" class="team-visionaries content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1 class="ara_title">
                        Nuestro equipo directivo
                    </h1>
                    <p style="text-align:center;">
                        Nuestro equipo directivo está conformado por profesionales con amplia experiencia en el
                        ámbito académico, empresarial y consultivo, comprometidos con la formación de excelencia y el
                        desarrollo de la profesión contable en la región.
                    </p>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-visionaries-member">
                                <figure>
                                    <img src="{{ asset('themes/webpage/images/v1.jpeg') }}"
                                        alt="" class="img-responsive">
                                    <figcaption>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Recusandae asperiores mollitia.</p>
                                        <ul>
                                            <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                        </ul>
                                    </figcaption>
                                </figure>
                                <h4>ALEX CUZCANO</h4>
                                <p>Academic Director - Autor del libro "El Amauta de las NIIF"</p>
                            </div><!-- /.team-visionaries-member-->
                        </div><!-- /.col-md-4 -->

                        <div class="col-md-4">
                            <div class="team-visionaries-member">
                                <figure>
                                    <img src="{{ asset('themes/webpage/images/v2.jpeg') }}"
                                        alt="" class="img-responsive">
                                    <figcaption>
                                        <p>Neque minima ea, a praesentium saepe nihil maxime quod esse
                                            numquam explicabo eligendi.</p>
                                        <ul>
                                            <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                        </ul>
                                    </figcaption>
                                </figure>
                                <h4>ROBERTO GODDOY</h4>
                                <p>Consulting Director</p>
                            </div><!-- /.team-visionaries-member-->
                        </div><!-- /.col-md-4 -->

                        <div class="col-md-4">
                            <div class="team-visionaries-member">
                                <figure>
                                    <img src="{{ asset('themes/webpage/images/v3.jpeg') }}"
                                        alt="" class="img-responsive">
                                    <figcaption>
                                        <p>Temporibus dolor, quisquam consectetur molestias, veniam
                                            voluptatum. Beatae alias omnis totam.</p>
                                        <ul>
                                            <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                            <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                        </ul>
                                    </figcaption>
                                </figure>
                                <h4>JOSÉ SÚCLUPE</h4>
                                <p>Commercial & Marketing Director</p>
                            </div><!-- /.team-visionaries-member-->
                        </div><!-- /.col-md-4 -->


                    </div><!-- /.row -->
                </div><!-- /.container -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.our-team-visionaries -->

    <style>
        .gray {
            color: #a5a5a5;
        }

        .team-visionaries {
            padding: 80px 0px;
        }

        .team-visionaries-member {
            margin: 15px;
            padding: 0;
        }

        .team-visionaries-member figure {
            position: relative;
            overflow: hidden;
            padding: 0;
            margin: 0;
        }

        .team-visionaries-member figure img {
            min-width: 100%;
        }

        .team-visionaries-member figcaption p {
            font-size: 16px;
        }

        .team-visionaries-member figcaption ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .team-visionaries-member figcaption ul {
            visibility: visible;
            -webkit-transition: all 0.1s ease-in-out;
            -moz-transition: all 0.1s ease-in-out;
            -o-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        .team-visionaries-member figcaption ul li {
            display: inline-block;
            padding: 10px;
        }

        .team-visionaries-member h4 {
            font-size: 18px;
            margin: 10px 0 0;
            padding: 0;
        }

        .team-visionaries-member figcaption {
            padding: 50px;
            color: transparent;
            background-color: transparent;
            position: absolute;
            z-index: 996;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            overflow: hidden;
            visibility: hidden;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .team-visionaries-member figure:hover figcaption {
            visibility: visible;
            color: #fff;
            background: rgba(230, 78, 62, 0.9);
            /* Primary color, can be changed via colors.css */

            height: 100%;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .team-visionaries-member figure:hover figcaption ul li a:hover {
            color: rgba(49, 49, 49, .97);
        }

        .team-visionaries-member figure img {
            -webkit-transform: scale(1) rotate(0) translateY(0);
            -moz-transform: scale(1) rotate(0) translateY(0);
            -o-transform: scale(1) rotate(0) translateY(0);
            -ms-transform: scale(1) rotate(0) translateY(0);
            transform: scale(1) rotate(0) translateY(0);
            -webkit-transition: all 0.4s ease-in-out;
            -moz-transition: all 0.4s ease-in-out;
            -o-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }

        .team-visionaries-member figure:hover img {
            -webkit-transform: scale(1.1) rotate(1deg) translateY(12px);
            -moz-transform: scale(1.1) rotate(1deg) translateY(12px);
            -o-transform: scale(1.1) rotate(1deg) translateY(12px);
            -ms-transform: scale(1.1) rotate(1deg) translateY(12px);
            transform: scale(1.1) rotate(1deg) translateY(12px);
            -webkit-transition: all 0.4s ease-in-out;
            -moz-transition: all 0.4s ease-in-out;
            -o-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }

        @media (max-width: 480px) {}
    </style>

</div>
