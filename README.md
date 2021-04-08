# Coding Challenge (Configuration)

Hi! If you're reading this, it's because you've been invited
to take a coding challenge for an engineering role at Divido.

This particular challenge is focused around writing a parser
for configuration files; more details on the exact scenario
are below.

We anticipate that you will spend around 2 hours working on
this challenge. If you don't manage to complete everything in
time, that's ok; it's not a race.

Once you've completed the challenge, please send your code to
your HR representative; you may provide it either as a link to
a repository on GitHub (preferred), or as a ZIP file.

## Scenario

For our (fictional) application to work correctly, we need to
be able to load one or more configuration files from disk and
merge them together. We have the following requirements:

1. It must be possible to load multiple configuration files
   at the same time, and have later files override settings
   in earlier ones.

2. It must be possible to retrieve parts of the configuration
   by a dot-separated path; this should work for both sections
   and for individual keys, no matter how deeply nested.

## Assumptions

1. All of the configuration files your code will process will
   be in JSON format.

2. Your code must be able to detect invalid JSON, and reject
   those configuration files. This should be explicitly handled
   (eg: do not let the error bubble up).

3. Although there are libraries available for parsing configuration
   files in the way that we describe, we expect you not to use them;
   that would be defeating the purpose of this test. You may use a
   library to parse the JSON, but not to fetch the data using the
   dot-separated path.

We have supplied example configuration files (in the `fixtures`
folder) which your code should be able to handle.

## Assessment Criteria

You may use any language or framework of your choice to complete this
assessment. Whatever your choice, we will use the following assessment
criteria:

1. **Clean code**: we value readability and separation of concerns. Make
   your code as simple as it can possibly be, but no simpler than that.

2. **Unit tests**: we value testing; you should demonstrate that you
   understand the fundamentals of how to test your application, and be
   able to suggest ways in which the testing could be improved. We will
   assess both your code, and the tests.

3. **Idiomatic code**: all languages have their own community standards;
   you should be aware of these, and be able to write code that meets those
   standards. For example, the [PSR-12](https://www.php-fig.org/psr/psr-12/) format for PHP.

4. **Documentation**: the ability to write clear and concise documentation
   is a skill in and of itself; feel free to provide an expanded `README`
   file with instructions on how to run your application. Use code comments
   liberally, and explain the _why_, not the _what_.

5. **Clean commit history**: one of the best ways for us to understand how
   you think is to see how you approached the problem. Commit early and often;
   don't be afraid to use multiple branches and make changes as you go.
   Logical, understandable commit messages are a bonus.

# Good Luck!
