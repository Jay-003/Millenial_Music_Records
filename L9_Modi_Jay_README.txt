<!--- The following README.md sample file was adapted from https://gist.github.com/PurpleBooth/109311bb0361f32d87a2#file-readme-template-md by Gabriella Mosquera for academic use ---> 
<!--- You may delete any comments in this sample README.md file. If needing to use as a .txt file then simply delete all comments, edit as needed, and save as a README.txt file --->

# LAB

**[Optional]** If what is being submitted is an individual Lab or Assignment. Otherwise, include a brief one paragraph description about the project.

* *Date Created*: 02 Dec 2023
* *Last Modification Date*: 07 Nov 2023
* *Activity URL*: https://web.cs.dal.ca/~jmodi/csci2170/lab9/

## Authors

* [Jay Modi](jay.modi@dal.ca)

## Built With

<!--- Provide a list of the frameworks used to build this application, your list should include the name of the framework used, the url where the framework is available for download and what the framework was used for, see the example below --->

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds
* [Bootstrap](https://getbootstrap.com) - Used for CSS
* [Lab2,5,7] - Used for the webpages
**

## Sources Used

If in completing your lab / assignment / project you used any interpretation of someone else's code, then provide a list of where the code was implement, how it was implemented, why it was implemented, and how it was modified. See the sections below for more details.

### File Name

*Lines 23 - 45*

```
Copy and paste your code on lines mentioned 

<form method="post" action="index.php">
        <div class="mb-3">
          <label for="validationCustom01" class="form-label">First name</label>
          <input type="text" class="form-control" id="validationCustom01" name="firstName" required>
        </div>
        <div class="mb-3">
          <label for="validationCustom02" class="form-label">Last name</label>
          <input type="text" class="form-control" id="validationCustom02" name="lastName" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputConfirmPassword1" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>

```

The code above was created by adapting the code in [Bootstrap](https://getbootstrap.com/docs/5.3/forms/validation/) as shown below: 

```
Copy and paste the snippet of code you are referencing

<form class="row g-3 needs-validation" novalidate>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom04" class="form-label">State</label>
    <select class="form-select" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>...</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom05" class="form-label">Zip</label>
    <input type="text" class="form-control" id="validationCustom05" required>
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>

```

- <!---How---> The code in [Bootstrap](https://getbootstrap.com/docs/5.3/forms/validation/) was implemented by... bootstrap 
- <!---Why---> [Bootstrap](https://getbootstrap.com/docs/5.3/forms/validation/)'s Code was used for CSS.
- <!---How---> [Bootstrap](https://getbootstrap.com/docs/5.3/forms/validation/)'s Code was modified by according to the lab's requirements.

*Repeat as needed*

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
