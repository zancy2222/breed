<?php include 'conn.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        .modal-body .form-group label {
            font-size: 18px;
        }
        .modal-body .form-control {
            height: 45px;
            font-size: 13px;
        }
    </style>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Rooster</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inventory-product.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Breed Name</label>
                                <select class="form-control" name="breed" required>
                                    <option value="" disabled selected>--Select Breed--</option>
                                    <?php
                                    include 'conn.php';
                                    $breeds_query = mysqli_query($conn, "SELECT * FROM db_category");
                                    while ($row = mysqli_fetch_assoc($breeds_query)) {
                                        ?>
                                        <option value="<?php echo $row['breed']; ?>"><?php echo $row['breed']; ?></option>
                                    <?php } ?>
                                </select>
                            </div><br>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Cockfighting Number</label>
                                <input type="number" class="form-control" name="prod_num" required>
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Hatched Date</label>
                                <input type="datetime-local" class="form-control" name="hatched" required>
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Achievements</label>
                                <input type="text" class="form-control" name="product_achieve">
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                    <h3 id="skill_name"> Skills</h3><hr>
                                    <div id="question_container"></div>
                                    <div id="percentage_display"></div> 

                                    <!-- Move the checkboxes here -->
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="skills[]" value="Intelligence Questions" class="intelligenceCheckbox"> Intelligence
                                    </label>&emsp;&ensp;
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="skills[]" value="Air Abilities Questions" class="airAbilitiesCheckbox"> Air Abilities
                                    </label>&emsp;&ensp;
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="skills[]" value="Land Abilities Questions" class="landAbilitiesCheckbox"> Land Abilities
                                    </label><br>
                                    <div class="intelligenceQuestions" style="display: none; border: 1px solid black;">
                            <p style="font-size: 15px; margin: 10px">Intelligence Questions:</p>
                            <!-- Example: -->
                            <div style="font-size: 12px; margin: 10px">
                                <p>1. Does the rooster/chicken show curiosity by investigating new objects in its environment?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q1" id="q1_yes" value="yes" required>
                                    <label class="form-check-label" for="q1_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q1" id="q1_no" value="no" required>
                                    <label class="form-check-label" for="q1_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>2. Does the rooster/chicken exhibit territorial behavior, such as defending its nesting area?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q2" id="q2_yes" value="yes" required>
                                    <label class="form-check-label" for="q2_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q2" id="q2_no" value="no" required>
                                    <label class="form-check-label" for="q2_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>3. Can the rooster/chicken learn to associate a specific sound with the arrival of food?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q3" id="q3_yes" value="yes" required>
                                    <label class="form-check-label" for="q3_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q3" id="q3_no" value="no" required>
                                    <label class="form-check-label" for="q3_no">No</label>
                                </div>
                            </div>
                            <!-- Add more intelligence questions here -->
                        </div>

                        <!-- Air Abilities Questions -->
                        <div class="airAbilitiesQuestions" style="display: none; border: 1px solid black;">
                            <p style="font-size: 15px; margin: 10px">Air Abilities Questions:</p>
                            <!-- Example: -->
                            <div style="font-size: 12px; margin: 10px">
                                <p>1. Can Rooster Air move really fast and dodge things easily?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q4" id="q4_yes" value="yes" required>
                                    <label class="form-check-label" for="q4_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q4" id="q4_no" value="no" required>
                                    <label class="form-check-label" for="q4_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>2. Can Rooster Air control wind and make attacks with it??</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q5" id="q5_yes" value="yes" required>
                                    <label class="form-check-label" for="q5_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q5" id="q5_no" value="no" required>
                                    <label class="form-check-label" for="q5_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>3. Can the chicken make a really loud noise to confuse enemies?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q6" id="q6_yes" value="yes" required>
                                    <label class="form-check-label" for="q6_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q6" id="q6_no" value="no" required>
                                    <label class="form-check-label" for="q6_no">No</label>
                                </div>
                            </div>
                            <!-- Add more air abilities questions here -->
                        </div>

                        <!-- Land Abilities Questions -->
                        <div class="landAbilitiesQuestions" style="display: none; border: 1px solid black;">
                            <p style="font-size: 15px; margin: 10px">Land Abilities Questions:</p>
                            <!-- Example: -->
                            <div style="font-size: 12px; margin: 10px">
                                <p >1. Can the rooster run at incredible speeds?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q7" id="q7_yes" value="yes" required>
                                    <label class="form-check-label" for="q7_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q7" id="q7_no" value="no" required>
                                    <label class="form-check-label" for="q7_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>2. Can the rooster deliver powerful strikes with its peck?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q8" id="q8_yes" value="yes" required>
                                    <label class="form-check-label" for="q8_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q8" id="q8_no" value="no" required>
                                    <label class="form-check-label" for="q8_no">No</label>
                                </div>
                            </div>
                            <div style="font-size: 12px; margin: 10px">
                                <p>3. Can the rooster mark its territory to deter intruders?</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q9" id="q9_yes" value="yes" required>
                                    <label class="form-check-label" for="q9_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="q9" id="q9_no" value="no" required>
                                    <label class="form-check-label" for="q9_no">No</label>
                                </div>
                            </div>
                            <!-- Add more land abilities questions here -->
                        </div>
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Product Quantity</label>
                                <input type="number" class="form-control" name="product_quant" value="1" readonly>
                            </div><br>
                        </div>
                    </div><br><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add_product" style="font-size: 18px;">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 18px;">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showQuestions(skill, title) {
        var skillNameSpan = document.getElementById('skill_name');
        var questionContainer = document.getElementById('question_container');
        var percentageDisplay = document.getElementById('percentage_display');

        // Modify the title based on the skill
        var displayTitle = title + " Questions";

        skillNameSpan.textContent = displayTitle;
        questionContainer.innerHTML = "";

        // Hide all question sections initially
        document.querySelectorAll('.intelligenceQuestions, .airAbilitiesQuestions, .landAbilitiesQuestions').forEach(function(el) {
            el.style.display = 'none';
        });

        // Show questions based on the selected skill
        switch (skill) {
            case "Intelligence Questions":
                document.querySelector('.intelligenceQuestions').style.display = 'block';
                break;
            case "Air Abilities Questions":
                document.querySelector('.airAbilitiesQuestions').style.display = 'block';
                break;
            case "Land Abilities Questions":
                document.querySelector('.landAbilitiesQuestions').style.display = 'block';
                break;
            default:
                // Handle default case
                break;
        }

        var modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var skillCheckboxes = document.querySelectorAll('.checkbox-label input[type="checkbox"]');
        skillCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    showQuestions(this.value, this.parentElement.textContent.trim());
                }
            });
        });

        // Add event listener for modal close event
        var modal = document.getElementById('productModal');
        modal.addEventListener('hidden.bs.modal', function () {
            skillCheckboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });
    });
</script>
