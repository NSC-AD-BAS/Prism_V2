<?php
#List php file:
#Author: Tim Davis
#Author: Kellan Nealy

include("common.php");

print_top();
?>

<!-- Main view -->
<main>
    <input id="searchbox" type="text" placeholder=" Search" />
    <h1>Internships</h1>

    <!-- Table -->
    <ul class="outer">
        <li class="tableHead">
            <ul class="inner">
                <li>Position</li>
                <li>Company</li>
                <li>Location</li>
            </ul>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Software Engineer</li>
                    <li>Facebook</li>
                    <li>Delaware</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Web Developer</li>
                    <li>Microsoft</li>
                    <li>Seattle, WA</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Software Engineer</li>
                    <li>Google</li>
                    <li>North Carolina</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Quality Assurance</li>
                    <li>Facebook</li>
                    <li>Ohio</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Pizza Delivery</li>
                    <li>Bookface</li>
                    <li>Rhode Island</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Software Engineer</li>
                    <li>Facebook</li>
                    <li>Delaware</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Web Developer</li>
                    <li>Microsoft</li>
                    <li>Seattle, WA</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Software Engineer</li>
                    <li>Google</li>
                    <li>North Carolina</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Quality Assurance</li>
                    <li>Facebook</li>
                    <li>Ohio</li>
                </ul>
            </a>
        </li>
        <li>
            <a href="detail.html">
                <ul class="inner">
                    <li>Pizza Delivery</li>
                    <li>Bookface</li>
                    <li>Rhode Island</li>
                </ul>
            </a>
        </li>
    </ul>
    <hr />

    <!-- Buttons -->
    <a class="button" href="create.html"><div>Create new Internship</div></a>
</main>

<?php
print_bottom();

?>
