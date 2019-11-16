const requestURL = 'https://byui-cit230.github.io/weather/data/towndata.json';

fetch(requestURL)
  .then(function (response) {
    return response.json();
  })
  .then(function (jsonObject) {
    console.table(jsonObject);  // temporary checking for valid response and data parsing

  const towns = jsonObject['towns'];
  const relevantTowns = ["Fish Haven", "Soda Springs", "Preston"];
  for (let i = 0; i < towns.length; i++ ) {
    if(relevantTowns.includes(towns[i].name)) {
        let card = document.createElement('section');
        let block = document.createElement('div');
        let h2 = document.createElement('h2');
        let townmotto = document.createElement('p');
        let foundedyear = document.createElement('p');
        let population = document.createElement('p');
        let annualrain = document.createElement('p');
        let townpic = document.createElement('img');
        
        card.className = 'towncard';
        block.classname = 'textblock';
        townmotto.className = 'motto';
        
        h2.textContent = towns[i].name
        townmotto.textContent = towns[i].motto;
        foundedyear.textContent = 'Year Founded: ' + towns[i].yearFounded;
        population.textContent = 'Population: ' + towns[i].currentPopulation;
        annualrain.textContent = 'Annual Rain Fall: ' + towns[i].averageRainfall;
        townpic.setAttribute('src', "images/" + towns[i].photo);
        townpic.setAttribute('alt', towns[i].name);

        card.appendChild(block);
        card.appendChild(townpic);
        block.appendChild(h2);
        block.appendChild(townmotto);
        block.appendChild(foundedyear);
        block.appendChild(population);
        block.appendChild(annualrain);
            
        
        document.querySelector('div.towndata').appendChild(card);
    }
  }
});