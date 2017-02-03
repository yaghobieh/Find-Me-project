<?php

  $getStoreName = $title;

  $query = "SELECT item_name, price, id, available, deliveryDays, deliveryPrice FROM store_items WHERE store_name = '$getStoreName' ";

  $statement = $databaseConnection->prepare($query);
  $statement->execute();
  if($statement->error)
  {
    die("Database query failed: " . $statement->error);
  }
  $statement->bind_result($itemName, $price, $id, $available, $deliveryDays, $deliveryPrice);
  while($statement->fetch())
  {
    ?>
    <script>
      $( document ).ready(function() {
        var $storeNameBin = '<?php echo $getStoreName; ?>';
        var $itemNameZoom = '<?php echo $itemName; ?>';
        var $itemPriceZoom = '<?php echo $price; ?>';
        var $itemID = '<?php echo $id; ?>';
        var $availableS = '<?php echo $available; ?>';
        var $deliveryDay = '<?php echo $deliveryDays; ?>';
        var $deliveryCost = '<?php echo $deliveryPrice; ?>';

        var $div = $('<div>');
        var $form = $('<form action=" " method="post" class="storeTopTitle">');
        var $editRegItem = $('<input type="submit" name="changeAspect" value="שנה">');
        var $delRegItem = $('<input type="submit" name="deleteItem" value="בטל מוצר זה">');
        var $checkIfAvailable = $('<select id="haveOrNo" name="haveOrNo"></select>');
        var $checkIfAvailable = $('<select id="haveOrNo" name="haveOrNo"></select>');
        $checkIfAvailable.append('<option value="<?php echo $available; ?> " selected="0"><?php echo $available; ?></option>');

        $checkIfAvailable.append('<option value="yes"">קיים במלאי</option>');
        $checkIfAvailable.append('<option value="no"">לא קיים במלאי</option>');
        $checkIfAvailable.attr('value', $availableS);


        var $divStoreNameBin = $( "<input type='hidden' name='storeNameBin' id='storeNameBin'>" );
        var $divNameBin = $( "<input type='hidden' name='getItemNameBin' id='getItemNameBin'>" );
        var $divPriceBin = $( "<input type='text' name='changePrice' id='changePrice'>" );
        var $divChangeDayDeliver = $( "<input type='text' name='chnageDeliverDay' id='chnageDeliverDay'>" );
        var $divDeliverPrice = $( "<input type='text' name='changePriceDelvier' id='changePriceDelvier'>" );


        $divPriceBin.attr("value",$itemPriceZoom); //Change Price
        $divNameBin.attr("placeholder", $itemNameZoom); //Hideen Name of
        $divStoreNameBin.attr("value", $storeNameBin);
        $divNameBin.attr("value", $itemNameZoom);
        $divChangeDayDeliver.attr("value", $deliveryDay);
        $divChangeDayDeliver.attr("placeholder", 'ימי הספקה');
        $divDeliverPrice.attr("value", $deliveryCost);
        $divDeliverPrice.attr("placeholder", 'עלות משלוח');

        $div.append($form);
        $form.append($divStoreNameBin);
        $form.append($divNameBin);
        $form.append($itemNameZoom + '<br>');
        $form.append($divPriceBin);
        $form.append($checkIfAvailable);
        $form.append($divChangeDayDeliver);
        $form.append($divDeliverPrice);
        $form.append($delRegItem);
        $form.append($editRegItem);
        $form.append('<br><hr><br>');

        $div.append($form);

        $('#getItemsIn').append($div);
      });

    </script>
    <?
  }

?>
