function bodyLoad(){
    if(window.innerHeight >= window.innerWidth){
        document.getElementById("regbut2_1").disabled = false;
        document.getElementById("regbut1_1").disabled = true;
    }else{
        document.getElementById("regbut2_1").disabled = true;
        document.getElementById("regbut1_1").disabled = false;
    };

    window.addEventListener('resize', function(){
        if(this.innerHeight >= this.innerWidth){
            document.getElementById("regbut2_1").disabled = false;
            document.getElementById("regbut1_1").disabled = true;
        }else{
            document.getElementById("regbut2_1").disabled = true;
            document.getElementById("regbut1_1").disabled = false;
        }
    });

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

    const personCount = document.getElementById("ilosc_osob");
    const kidCount = document.getElementById("ilosc_dzieci");
    const luggageCount = document.getElementById("ilosc_bagazu");
    personCount.addEventListener("change", () => {
        let pCount = parseInt(personCount.value);
        let kidStr = '';
        let lugStr = '';
        for(let i=0; i<=pCount;i++){
            kidStr += `<option value=${i}>${i}</option>`;
        };
        kidCount.innerHTML = kidStr;
        for (let i=1; i<=pCount*2;i++){
            lugStr += `<option value=${i}>${i}</option>`;
        };
        luggageCount.innerHTML = lugStr;
    });

    kidCount.addEventListener("change", () => {
        let count = parseInt(kidCount.value);
        if(count == 0){
            document.getElementById("kidages").style.display = "none";
            for (let i=1; i<=8; i++) {
                document.getElementById(`wiek_dziecko${i}`).hidden = true;
                document.getElementById(`wiek_dziecko${i}`).disabled = true;
            }
        }else{
            document.getElementById("kidages").style.display = "block";
            for (let i=1; i<=count; i++) {
                document.getElementById(`wiek_dziecko${i}`).hidden = false;
                document.getElementById(`wiek_dziecko${i}`).disabled = false;
            }
            
            for (let i=count+1; i<=8; i++) {
                document.getElementById(`wiek_dziecko${i}`).hidden = true;
                document.getElementById(`wiek_dziecko${i}`).disabled = true;
            }
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
    const kid1 = document.getElementById("wiek_dziecko1");
    const kid2 = document.getElementById("wiek_dziecko2");
    const kid3 = document.getElementById("wiek_dziecko3");
    const kid4 = document.getElementById("wiek_dziecko4");
    const kid5 = document.getElementById("wiek_dziecko5");
    const kid6 = document.getElementById("wiek_dziecko6");
    const kid7 = document.getElementById("wiek_dziecko7");
    const kid8 = document.getElementById("wiek_dziecko8");
    const kidJSON = document.getElementById("kidsJSON");
    let kJSON = [];
    let i = 0;
    let kid1i, kid2i, kid3i, kid4i, kid5i, kid6i, kid7i, kid8i;
    kid1.addEventListener("change", () => {
        if(kid1.value != '' && isNaN(kid1i)){
            kJSON.push(`{"wiek":${kid1.value}}`);
            kid1i = i;
            i++;
        }else if(kid1.value != '' && !isNaN(kid1i)){
            kJSON[kid1i] = `{"wiek":${kid1.value}}`
        }else{
            kJSON.pop(kid1i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid2.addEventListener("change", () => {
        if(kid2.value != '' && isNaN(kid2i)){
            kJSON.push(`{"wiek":${kid2.value}}`);
            kid2i = i;
            i++;
        }else if(kid2.value != '' && !isNaN(kid2i)){
            kJSON[kid2i] = `{"wiek":${kid2.value}}`
        }else{
            kJSON.pop(kid2i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid3.addEventListener("change", () => {
        if(kid3.value != '' && isNaN(kid3i)){
            kJSON.push(`{"wiek":${kid3.value}}`);
            kid3i = i;
            i++;
        }else if(kid3.value != '' && !isNaN(kid3i)){
            kJSON[kid3i] = `{"wiek":${kid3.value}}`
        }else{
            kJSON.pop(kid3i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid4.addEventListener("change", () => {
        if(kid4.value != '' && isNaN(kid4i)){
            kJSON.push(`{"wiek":${kid4.value}}`);
            kid4i = i;
            i++;
        }else if(kid4.value != '' && !isNaN(kid4i)){
            kJSON[kid4i] = `{"wiek":${kid4.value}}`
        }else{
            kJSON.pop(kid4i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid5.addEventListener("change", () => {
        if(kid5.value != '' && isNaN(kid5i)){
            kJSON.push(`{"wiek":${kid5.value}}`);
            kid5i = i;
            i++;
        }else if(kid5.value != '' && !isNaN(kid5i)){
            kJSON[kid5i] = `{"wiek":${kid5.value}}`
        }else{
            kJSON.pop(kid5i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid6.addEventListener("change", () => {
        if(kid6.value != '' && isNaN(kid6i)){
            kJSON.push(`{"wiek":${kid6.value}}`);
            kid6i = i;
            i++;
        }else if(kid6.value != '' && !isNaN(kid6i)){
            kJSON[kid6i] = `{"wiek":${kid6.value}}`
        }else{
            kJSON.pop(kid6i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid7.addEventListener("change", () => {
        if(kid7.value != '' && isNaN(kid7i)){
            kJSON.push(`{"wiek":${kid7.value}}`);
            kid7i = i;
            i++;
        }else if(kid7.value != '' && !isNaN(kid7i)){
            kJSON[kid7i] = `{"wiek":${kid7.value}}`
        }else{
            kJSON.pop(kid7i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });
    kid8.addEventListener("change", () => {
        if(kid8.value != '' && isNaN(kid8i)){
            kJSON.push(`{"wiek":${kid8.value}}`);
            kid8i = i;
            i++;
        }else if(kid8.value != '' && !isNaN(kid8i)){
            kJSON[kid8i] = `{"wiek":${kid8.value}}`
        }else{
            kJSON.pop(kid8i);
            i--;
        }
        kidJSON.value = "["+kJSON.join(',')+"]";
    });

    const firma_adres = document.getElementById('firma_adres');
    const nip = document.getElementById('nip');
    const firma = document.getElementById('firma');
    const dane_faktura = document.getElementById('dane_faktura');
    let fJSON = {
        adres:null,
        nip:null,
        nazwa:null
    };
    firma_adres.addEventListener("change", () => {
        if(firma_adres.value != ''){
            fJSON.adres = `${firma_adres.value}`;
        }else{
            fJSON.adres = null;
        }
        dane_faktura.value = JSON.stringify(fJSON);
    });
    nip.addEventListener("change", () => {
        if(nip.value != ''){
            fJSON.nip =`${nip.value}`;
        }else{
            fJSON.nip = null;
        }
        dane_faktura.value = JSON.stringify(fJSON);
    });
    firma.addEventListener("change", () => {
        if(firma.value != ''){
            fJSON.nazwa =`${firma.value}`;

        }else{
            fJSON.nazwa = null;
        }
        dane_faktura.value = JSON.stringify(fJSON);
    });


}