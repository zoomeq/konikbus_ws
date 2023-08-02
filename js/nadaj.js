function bodyLoad(){


    const fakturaBox = document.getElementById("faktura");
    fakturaBox.addEventListener("change", () => {
        if(fakturaBox.checked){
            document.getElementById("fakt").style.display = "block";
            document.getElementById("nip").disabled = false;
            document.getElementById("firma").disabled = false;
            document.getElementById("firma_adres").disabled = false;
            document.getElementById('invoice').value = 1;
        }else{
            document.getElementById("fakt").style.display = "none";
            document.getElementById("nip").disabled = true;
            document.getElementById("firma").disabled = true;
            document.getElementById("firma_adres").disabled = true;
            document.getElementById('invoice').value = 0;
        }
    });
    const region1 = document.getElementById("region1");
    const region2 = document.getElementById("region2");
    region1.addEventListener("change",  () => {
        const regionFrom = document.getElementById("regionFrom");
        switch (region1.value) {
            case 'PL':
                regionFrom.value = 1;
                break;
            case 'DE':
                regionFrom.value = 2;
                break;
            case 'BE':
                regionFrom.value = 4;
                break;
            case 'NL':
                regionFrom.value = 3;
                break;
            case 'LU':
                regionFrom.value = 5;
                break;        
            default:
                regionFrom.value = 1;
                break;
        }
    });
    region2.addEventListener("change",  () => {
        const regionTo = document.getElementById("regionTo");
        switch (region2.value) {
            case 'PL':
                regionTo.value = 1;
                break;
            case 'DE':
                regionTo.value = 2;
                break;
            case 'BE':
                regionTo.value = 4;
                break;
            case 'NL':
                regionTo.value = 3;
                break;
            case 'LU':
                regionTo.value = 5;
                break;        
            default:
                regionTo.value = 1;
                break;
        };
    });
    const platnosc = document.getElementById("platnosc");
    platnosc.addEventListener("change", () => {
        const payment = document.getElementById("payment");
        switch (platnosc.value) {
            case "kierowca":
                payment.value = -1;
                break;
            case "na_miejscu":
                payment.value = -2;
                break;
            case "przelew":
                payment.value = -3;
                break;
            default:
                payment.value = -1;
                break;
        };
    });

    const firma_adres = document.getElementById('firma_adres');
    const nip = document.getElementById('nip');
    const firma = document.getElementById('firma');
    const dane_faktura = document.getElementById('dane_faktura');
    let fJSON = []
    let j = 0;
    let adress_index, company_index, tax_index;

    firma_adres.addEventListener("change", () => {
        if(firma_adres.value != '' && isNaN(adress_index)){
            fJSON.push(`{"adres":"${firma_adres.value}"}`);
            adress_index = j;
            j++;
        }else if(firma_adres.value != '' && !isNaN(adress_index)){
            fJSON[adress_index] = `{"adres":"${firma_adres.value}"}`
        }else{
            fJSON.pop(adress_index);
            i--;
        }
        dane_faktura.value = "["+fJSON.join(',')+"]";
    });
    nip.addEventListener("change", () => {
        if(nip.value != '' && isNaN(tax_index)){
            fJSON.push(`{"nip":${nip.value}}`);
            tax_index = j;
            j++;
        }else if(nip.value != '' && !isNaN(tax_index)){
            fJSON[tax_index] = `{"nip":${nip.value}}`
        }else{
            fJSON.pop(tax_index);
            i--;
        }
        dane_faktura.value = "["+fJSON.join(',')+"]";
    });
    firma.addEventListener("change", () => {
        if(firma.value != '' && isNaN(company_index)){
            fJSON.push(`{"nazwa":"${firma.value}"}`);
            company_index = j;
            j++;
        }else if(firma.value != '' && !isNaN(company_index)){
            fJSON[company_index] = `{"nazwa":"${firma.value}"}`
        }else{
            fJSON.pop(company_index);
            i--;
        }
        dane_faktura.value = "["+fJSON.join(',')+"]";
    });
}