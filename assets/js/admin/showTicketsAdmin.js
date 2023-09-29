const InfoSelectors = document.querySelectorAll('.ticket-link');
const actionButtonCard = document.querySelector('.left-card-footer');
const pcName = document.querySelector('.pcName');
const errorCode = document.querySelector('.errorCode');
const site = document.querySelector('.site');
const brand = document.querySelector('.brand');
const immat = document.querySelector('.immat');

let abortController;
InfoSelectors.forEach(link => {
    link.addEventListener('click', async (event) => {
        console.log('prout');
        event.preventDefault();
        actionButtonCard.style.display = 'flex';
        actionButtonCard.style.justifyContent = 'center';
    if (abortController)
    {
        abortController.abort();
    }
    
    abortController = new AbortController();
    const ticketData = await fetch("/admin/show/"+link.dataset.id, {
        signal: abortController.signal
    })

    .then(response => response.json())
    if(ticketData.className == 'ItTicket')
    {
        pcName.style.display = 'block';
        errorCode.style.display = 'block';
        
        site.style.display = 'none';
        brand.style.display = 'none';
        immat.style.display = 'none';

        pcName.innerHTML = ticketData.pcName;
        errorCode.innerHTML = ticketData.errorCode;
    }
    if(ticketData.className == 'VehicleTicket')
    {
        pcName.style.display = 'none';
        errorCode.style.display = 'none';
        site.style.display = 'none';

        brand.style.display = 'block';
        immat.style.display = 'block';

        brand.innerHTML = ticketData.brand;
        immat.innerHTML = ticketData.immat;
    }
    if(ticketData.className == 'BuildingTicket')
    {
        pcName.style.display = 'none';
        errorCode.style.display = 'none';
        brand.style.display = 'none';
        immat.style.display = 'none';

        site.style.display = 'block';
        site.innerHTML = ticketData.site;
    }
    const date = (new Date(ticketData.date.date).toLocaleDateString('fr-FR', {year: 'numeric', month: 'long', day: 'numeric'}));
    document.querySelector('.ticket-title').innerHTML = ticketData.title;
    document.querySelector('.description-info').innerHTML = ticketData.description;
    document.querySelector('.ticket-date').innerHTML = date;
    document.querySelector('.ticket-solved').innerHTML = ticketData.solved? "oui":"non";
    document.querySelector('.createBy').innerHTML = ticketData.createByFirstName +' '+ticketData.createByName
    document.querySelector('.localisation').innerHTML= ticketData.localisation
})})