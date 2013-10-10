<!-- RECOMMENDED PRODUCTS BLOCK -->
<section class="w749">

    <h2 class="font18 mb6">Мы рекомендуем</h2>
    <p class="mb10">Специально для Вас мы подобрали список продуктов которые рекомендуются применять совместно с просматриваемым товаром</p>

    <div class="bxsliderMultiBlocks">
        <div class="item">

            <?php foreach ($listProductsFeatured as $n=>$product){ ?>
                <section class="shadowHover w133 h199 left shadow bgWhite <?=($n)?'ml21':''?>">
                    <figure>
                        <a rel="nofollow" href="<?=$product['url'];?>" title="<?=$product['name']?>">
                            <img style="width: 133px" src="<?=$product['image']?>" alt="<?=$product['name']?>">
                        </a>
                    </figure>
                    <a class="itemName font13 mb3" href="<?=$product['url'];?>" title="<?=$product['name']?>"><?=$product['name']?></a>
                    <form class="formStyle" method="post" action="">
                        <table class="formTable">
                            <tbody>
                            <tr class="h30 font11">
                                <td class="vam tac" width="76"><?=$product['price']?></td>
                                <td>&nbsp;</td>
                                <td class="h30" width="88"><input type="submit" class="formSubmit submitGray greenHover shadowBtn right" value="В корзину"/></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </section>
                <? if($n > 2 && $n+1 < count($listProductsFeatured)){?>
                    </div>
                    <div class="item">
                <? } ?>
            <? } ?>
        </div>

    </div>
    <div class="clearfix"></div>

</section>
<!-- END RECOMMENDED PRODUCTS BLOCK -->