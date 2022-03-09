function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the items:*/
var items = ["Arcane Staff","Armored Horse","Assassin Hood","Assassin Jacket","Assassin Shoes","Bag","Battleaxe","Bear Paws","Bedrock Mace","Black Hands","Black Monk Stave","Blazing Staff","Blight Staff","Bloodletter","Boltcasters","Bonehorse","Bow","Bow of Badon","Brimstone Staff","Broadsword","Caitiff Shield","Camlann Mace","Cape","Carrioncaller","Carving Sword","Clarent Blade","Claws","Claymore","Cleric Cowl","Cleric Robe","Cleric Sandals","Cloth","Crossbow","Crypthandle","Cultist Cowl","Cultist Robe","Cultist Sandals","Cursed Skull","Cursed Staff","Dagger","Dagger Pair","Damnation Staff","Deathgivers","Demolition Hammer","Demon Armor","Demon Boots","Demon Helmet","Demonic Staff","Direwolf","Divine Staff","Double Bladed Staff","Druid Cowl","Druid Robe","Druid Sandals","Druidic Staff","Dual Swords","Enigmatic Staff","Eye of Secrets","Facebreaker","Fallen Staff","Fiend Cowl","Fiend Robe","Fiend Sandals","Fire Staff","Forge Hammers","Frost Staff","Galatine Pair","Giant Stag","Gigantify Potion","Glacial Staff","Glaive","Graveguard Armor","Graveguard Boots","Graveguard Helmet","Great Arcane Staff","Great Cursed Staff","Great Fire Staff","Great Frost Staff","Great Hammer","Great Holy Staff","Great Nature Staff","Greataxe","Grovekeeper","Guardian Armor","Guardian Boots","Guardian Helmet","Halberd","Hammer","Harvester Backpack","Harvester Cap","Harvester Garb","Harvester Workboots","Healing Potion","Heavy Crossbow","Heavy Mace","Hellion Hood","Hellion Jacket","Hellion Shoes","Heron Spear","Hoarfrost Staff","Holy Staff","Hunter Hood","Hunter Jacket","Hunter Shoes","Icicle Staff","Incubus Mace","Infernal Scythe","Infernal Staff","Invisibility Potion","Iron-clad Staff","Judicator Armor","Judicator Boots","Judicator Helmet","Knight Armor","Knight Boots","Knight Helmet","Leather","Leering Cane","Lifecurse Staff","Lifetouch Staff","Light Crossbow","Longbow","Lumberjack Backpack","Lumberjack Cap","Lumberjack Garb","Lumberjack Workboots","Mace","Mage Cowl","Mage Robe","Mage Sandals","Malevolent Locus","Mercenary Hood","Mercenary Jacket","Mercenary Shoes","Metal Bar","Miner Backpack","Miner Cap","Miner Garb","Miner Workboots","Mistcaller","Morning Star","Muisak","Nature Staff","Nightmare","Occult Staff","Ore","Permafrost Prism","Pickaxe","Pike","Planks","Poison Potion","Polehammer","Quarrier Backpack","Quarrier Cap","Quarrier Garb","Quarrier Workboots","Quarterstaff","Rampant Staff","Redemption Staff","Resistance Potion","Riding Horse","Rock","Saddled Direbear","Saddled Direboar","Saddled Swampdragon","Sarcophagus","Scholar Cowl","Scholar Robe","Scholar Sandals","Shield","Sickle","Siegebow","Skinner Backpack","Skinner Cap","Skinner Garb","Skinner Workboots","Skinning Knife","Soldier Armor","Soldier Boots","Soldier Helmet","Soulscythe","Spear","Specter Hood","Specter Jacket","Specter Shoes","Spectral Bonehorse","Spirithunter","Staff of Balance","Stalker Hood","Stalker Jacket","Stalker Shoes","Sticky Potion","Stone Block","Stone Hammer","Swiftclaw","Taproot","Tombhammer","Tome of Spells","Torch","Transport Mammoth","Transport Ox","Trinity Spear","Wailing Bow","Warbow","Warhorse","Weeping Repeater","Whispering Bow","Wild Staff","Wildfire Staff","Witchwork Staff","Wood Axe"];


autocomplete(document.getElementById("inputItem"), items);

document.getElementById('inputItem')
  .addEventListener('keyup', function(event) {
    if (event.code === 'Enter') {
      event.preventDefault();
      document.querySelector('form').submit();
    }
  });