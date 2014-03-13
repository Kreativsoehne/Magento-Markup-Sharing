# Magento: Markup Sharing

**The short story:**

This block is able to retreive markup from an external source and inject it to magento's markup via XML layouts and magento's CMS functionality. Bazinga!


**The longer story:**

Do you think 'Uh, WTF?! Why would I need that?'. Well - We're upset by the not-so-good native 'CMS' thing which comes along with Magento. It's just a creepy bad markup editor which makes more problems than it solves when it comes to the client/user and his needs and the way he/she thinks. In most cases these people aren't that good HTML cracks. Surprise :)

We've been trying out a bunch of Magento extensions which are meant to raise up Magento's CMS features by adding very much stuff to them. But we didn't like them all for multiple reasons. Often they are too complicated, don't feel right, are just bad or all together.

That was the moment when we thought *'why should we try making magento a CMS when there are very good CMS out there?'*. There is a bunch of solutions for integrating CMS in Magento out there, too. Like said before: They are mostly too heavy and full of unneccessary features or they try to integrate the CMS in a very strange way.

So, we came up with a simple, easy-to-implement, yet flexible idea: *All a CMS does is what? - Well, it generates markup.* So, all we need to do is to grab that markup and inject it into our shop's markup. And that's what this block does; You can use any markup generator you want as long as it's markup is available through http(s). You can even use static HTML, too.

This block will call the url from the external_url parameter, then cache it's content using magento's native cache functionality and print it out anywhere you want. And that's it. No magic, no heavy attempts of bringing a (customer-) useable CMS to Magento. Just use what they already have and know. 

It's that simple.

## Installation

1. Copy the extension's files to your shop's root directory.
2. Make some blocks (See 'Usage')
3. Profit.

## USAGE


### Use this block in your layout XML files like this:

	<block type="kus_markupsharing/external" name="kus.external">
	  <action method="setData"><name>external_url</name><value><![CDATA[http://url.to/external/markup.html]]></value></action>
	  <!-- optional --><action method="setData"><name>regex</name><value><![CDATA[this is a regex]]></value></action>
	  <!-- optional --><action method="setCacheLifetime"><lifetime>1337</lifetime></action>
	</block>

(The Regex feature is experimental and may not work in this version)

### Or you can use it in CMS pages and static blocks, too:

	{{block type="kus_markupsharing/external" external_url="http://url.to/external/markup.html"}}

	// set a special cache lifetime
	{{block type="kus_markupsharing/external" external_url="http://url.to/external/markup.html" lifetime="1337"}}


### Tips & Tricks

If you don't want to make your markup available for public, you can use htaccess authorization. Just un-comment some lines in KuS_MarkupSharing_Helper_Data::getExternalMarkup(). You'll know what we mean when you take a look at the code.

### Limitations

Life's bad. Everything good comes along with something bad. That's why there are some limitations you should know:

- You better should use absolute URLs in your external markup for images, forms, css & js files and so on.

- Forms can be used, too. But they can't be processed by magento. So, that's the job of your external CMS. Take care of setting the form's action url to the correct URL.

## Compatibility

Tested with Magento 1.7 Community Edition. But should run with any other, too. Please let us know.


## Support & Feedback

Please use Github's issue tracker to tell us you problems, whishes and needs.


## Contribution
Feel free to fork this little project. It would be nice to tell us your results by placing a pull request when you think this project will benefit from these changes.
