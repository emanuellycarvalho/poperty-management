<?php include('./templates/header.php'); ?>

<div class="faq-container">
    <h1>Frequently Asked Questions (FAQ)</h1>

    <div class="faq-section">
        <button class="accordion">What do I need to know before buying a house?</button>
        <div class="panel">
            <p>Before buying a house, it's important to check your finances, know your budget, research different areas, and understand the ongoing costs, such as mortgage, insurance, and property taxes. It's also wise to get pre-approved for a loan to ensure you're ready when you find the right property.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">What are the steps involved in purchasing a property?</button>
        <div class="panel">
            <p>The typical steps involved in purchasing a property include: 1. Determining your budget, 2. Getting pre-approved for a loan, 3. Finding a real estate agent, 4. Viewing properties, 5. Making an offer, 6. Completing paperwork and legal requirements, 7. Finalising the loan, and 8. Closing the deal.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">How do I make an offer on a property?</button>
        <div class="panel">
            <p>To make an offer, contact the seller or the real estate agent. They will guide you through the process and help determine the appropriate offer based on market value, comparable sales, and the property's condition.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">What is the difference between buying and renting?</button>
        <div class="panel">
            <p>Buying a property means you're paying towards ownership, while renting is a temporary arrangement where you pay monthly rent without building equity. Owning a home gives you long-term security and investment potential, while renting offers flexibility with fewer responsibilities.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">How do I get pre-approved for a mortgage?</button>
        <div class="panel">
            <p>To get pre-approved for a mortgage, you will need to provide documentation such as your income, credit history, employment status, and outstanding debts. A lender will review this information and give you a pre-approval letter, which will tell you the maximum amount you can borrow.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">What costs are involved in buying a home?</button>
        <div class="panel">
            <p>Besides the purchase price, there are additional costs such as stamp duty, home inspections, closing costs, loan fees, and possibly renovation costs. It’s important to account for these expenses when budgeting for your new home.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">How long does the home buying process take?</button>
        <div class="panel">
            <p>The process can vary, but typically, from the time you make an offer until closing takes around 4 to 8 weeks. This includes time for inspections, loan processing, and completing legal documents.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">Can I negotiate the price of a property?</button>
        <div class="panel">
            <p>Yes, you can negotiate. Many buyers negotiate the price of the property, especially if it has been on the market for a while or if there are any issues with the property. It's always worth asking for a better price, especially if you have done your research on comparable properties in the area.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">What happens after I make an offer?</button>
        <div class="panel">
            <p>After making an offer, the seller may accept, reject, or counter the offer. If they counter, you can either accept their new terms or negotiate further. Once the offer is accepted, you will begin the process of signing contracts, obtaining financing, and completing inspections.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="accordion">What should I look for during a home inspection?</button>
        <div class="panel">
            <p>During a home inspection, you should look for any structural issues, electrical problems, plumbing issues, roof condition, and overall maintenance of the property. It’s essential to hire a professional inspector to ensure the property is in good condition before purchasing.</p>
        </div>
    </div>
</div>

<script>
const accordions = document.querySelectorAll('.accordion');

accordions.forEach(acc => {
    acc.addEventListener('click', function() {
        this.classList.toggle('active');
        const panel = this.nextElementSibling;

        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
});
</script>


<?php include('./templates/footer.php'); ?>
